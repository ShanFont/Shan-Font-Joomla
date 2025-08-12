<?php
/**
 * @package     Shan Font Plugin
 * @subpackage  System
 * @copyright   Copyright (C) 2025 TaiDev. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Document\HtmlDocument;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;
use Joomla\Event\Event;
use Joomla\Event\SubscriberInterface;

/**
 * Shan Font System Plugin
 *
 * @since  1.0.0
 */
class PlgSystemShanfont extends CMSPlugin implements SubscriberInterface
{
    /**
     * Application object
     *
     * @var    CMSApplication
     * @since  1.0.0
     */
    protected $app;

    /**
     * Returns an array of events this subscriber will listen to.
     *
     * @return  array
     * @since   1.0.0
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onBeforeCompileHead' => 'onBeforeCompileHead',
        ];
    }

    /**
     * Plugin that adds Shan font support to the site
     *
     * @param   Event  $event  The event object
     *
     * @return  void
     * @since   1.0.0
     */
    public function onBeforeCompileHead(Event $event): void
    {
        // Only run on frontend
        if (!$this->app->isClient('site')) {
            return;
        }

        $document = $this->app->getDocument();

        // Only process HTML documents
        if (!($document instanceof HtmlDocument)) {
            return;
        }

        $mode = $this->params->get('font_mode', 'quick_setup');

        switch ($mode) {
            case 'theme_defaults':
                $this->removeCustomFonts($document);
                break;
            case 'quick_setup':
                $this->applyQuickSetup($document);
                break;
            case 'custom_selection':
                $this->applyCustomSelection($document);
                break;
        }
    }

    /**
     * Remove custom fonts and restore theme defaults
     *
     * @param   HtmlDocument  $document  The document object
     *
     * @return  void
     * @since   1.0.0
     */
    private function removeCustomFonts(HtmlDocument $document): void
    {
        // Add CSS to reset fonts to theme defaults
        $css = '
        /* Reset Shan Fonts to Theme Defaults */
        * {
            font-family: initial !important;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
        }';
        
        $document->addStyleDeclaration($css);
    }

    /**
     * Apply quick setup mode with all Shan fonts
     *
     * @param   HtmlDocument  $document  The document object
     *
     * @return  void
     * @since   1.0.0
     */
    private function applyQuickSetup(HtmlDocument $document): void
    {
        $useCdn = $this->params->get('use_cdn', 1);
        
        if ($useCdn) {
            // Try to load from CDN first
            $document->addStyleSheet('https://cdn.jsdelivr.net/gh/ShanFont/ShanFont@main/shan.css');
            
            // Add fallback script to load local fonts if CDN fails
            $this->addCdnFallback($document);
        } else {
            // Load local fonts directly
            $this->loadLocalShanFonts($document);
        }

        // Apply Shan font to all elements
        $this->applyShanFontGlobally($document);
    }

    /**
     * Apply custom font selection
     *
     * @param   HtmlDocument  $document  The document object
     *
     * @return  void
     * @since   1.0.0
     */
    private function applyCustomSelection(HtmlDocument $document): void
    {
        $selectedFonts = $this->params->get('custom_fonts', []);
        
        if (empty($selectedFonts)) {
            return;
        }

        $useCdn = $this->params->get('use_cdn', 1);
        
        if ($useCdn) {
            // For custom selection, we need to load specific fonts
            $this->loadCustomCdnFonts($document, $selectedFonts);
            $this->addCdnFallback($document, $selectedFonts);
        } else {
            $this->loadLocalCustomFonts($document, $selectedFonts);
        }

        // Apply selected Shan fonts
        $this->applyShanFontGlobally($document);
    }

    /**
     * Load all local Shan fonts
     *
     * @param   HtmlDocument  $document  The document object
     *
     * @return  void
     * @since   1.0.0
     */
    private function loadLocalShanFonts(HtmlDocument $document): void
    {
        $fontPath = Uri::root() . 'plugins/system/shanfont/fonts/';
        
        $fonts = [
            'Shan-Thin.woff2' => ['font-weight' => '100', 'font-style' => 'normal'],
            'Shan-ThinItalic.woff2' => ['font-weight' => '100', 'font-style' => 'italic'],
            'Shan-Regular.woff2' => ['font-weight' => '400', 'font-style' => 'normal'],
            'Shan-Italic.woff2' => ['font-weight' => '400', 'font-style' => 'italic'],
            'Shan-Bold.woff2' => ['font-weight' => '700', 'font-style' => 'normal'],
            'Shan-BoldItalic.woff2' => ['font-weight' => '700', 'font-style' => 'italic'],
            'Shan-Black.woff2' => ['font-weight' => '900', 'font-style' => 'normal'],
            'Shan-BlackItalic.woff2' => ['font-weight' => '900', 'font-style' => 'italic'],
        ];

        $css = $this->generateFontFaceCss($fonts, $fontPath);
        $document->addStyleDeclaration($css);
    }

    /**
     * Load custom local fonts based on selection
     *
     * @param   HtmlDocument  $document       The document object
     * @param   array         $selectedFonts  Selected font files
     *
     * @return  void
     * @since   1.0.0
     */
    private function loadLocalCustomFonts(HtmlDocument $document, array $selectedFonts): void
    {
        $fontPath = Uri::root() . 'plugins/system/shanfont/fonts/';
        
        $fontDefinitions = [
            'Shan-Thin.woff2' => ['font-weight' => '100', 'font-style' => 'normal'],
            'Shan-ThinItalic.woff2' => ['font-weight' => '100', 'font-style' => 'italic'],
            'Shan-Regular.woff2' => ['font-weight' => '400', 'font-style' => 'normal'],
            'Shan-Italic.woff2' => ['font-weight' => '400', 'font-style' => 'italic'],
            'Shan-Bold.woff2' => ['font-weight' => '700', 'font-style' => 'normal'],
            'Shan-BoldItalic.woff2' => ['font-weight' => '700', 'font-style' => 'italic'],
            'Shan-Black.woff2' => ['font-weight' => '900', 'font-style' => 'normal'],
            'Shan-BlackItalic.woff2' => ['font-weight' => '900', 'font-style' => 'italic'],
        ];

        $fonts = [];
        foreach ($selectedFonts as $fontFile) {
            if (isset($fontDefinitions[$fontFile])) {
                $fonts[$fontFile] = $fontDefinitions[$fontFile];
            }
        }

        if (!empty($fonts)) {
            $css = $this->generateFontFaceCss($fonts, $fontPath);
            $document->addStyleDeclaration($css);
        }
    }

    /**
     * Load custom CDN fonts
     *
     * @param   HtmlDocument  $document       The document object
     * @param   array         $selectedFonts  Selected font files
     *
     * @return  void
     * @since   1.0.0
     */
    private function loadCustomCdnFonts(HtmlDocument $document, array $selectedFonts): void
    {
        // For custom selection with CDN, we'll load the full CDN and hide unused fonts
        $document->addStyleSheet('https://cdn.jsdelivr.net/gh/ShanFont/ShanFont@main/shan.css');
    }

    /**
     * Generate @font-face CSS
     *
     * @param   array   $fonts     Font definitions
     * @param   string  $fontPath  Path to fonts
     *
     * @return  string
     * @since   1.0.0
     */
    private function generateFontFaceCss(array $fonts, string $fontPath): string
    {
        $css = "/* Shan Font Definitions */\n";
        
        foreach ($fonts as $fontFile => $properties) {
            $css .= "@font-face {\n";
            $css .= "  font-family: 'Shan';\n";
            $css .= "  src: url('{$fontPath}{$fontFile}') format('woff2');\n";
            $css .= "  font-weight: {$properties['font-weight']};\n";
            $css .= "  font-style: {$properties['font-style']};\n";
            $css .= "  font-display: swap;\n";
            $css .= "}\n\n";
        }
        
        return $css;
    }

    /**
     * Apply Shan font globally to the website
     *
     * @param   HtmlDocument  $document  The document object
     *
     * @return  void
     * @since   1.0.0
     */
    private function applyShanFontGlobally(HtmlDocument $document): void
    {
        $css = '
        /* Apply Shan Font Globally */
        body, html {
            font-family: "Shan", Arial, sans-serif !important;
        }
        
        * {
            font-family: inherit !important;
        }
        
        /* Specific elements that might override */
        h1, h2, h3, h4, h5, h6,
        p, div, span, a, button, input, textarea, select,
        .navbar, .menu, .content, .article, .blog {
            font-family: "Shan", Arial, sans-serif !important;
        }';
        
        $document->addStyleDeclaration($css);
    }

    /**
     * Add CDN fallback script
     *
     * @param   HtmlDocument  $document       The document object
     * @param   array|null    $selectedFonts  Selected fonts for custom mode
     *
     * @return  void
     * @since   1.0.0
     */
    private function addCdnFallback(HtmlDocument $document, ?array $selectedFonts = null): void
    {
        $fontPath = Uri::root() . 'plugins/system/shanfont/fonts/';
        
        $allFonts = [
            'Shan-Thin.woff2' => ['font-weight' => '100', 'font-style' => 'normal'],
            'Shan-ThinItalic.woff2' => ['font-weight' => '100', 'font-style' => 'italic'],
            'Shan-Regular.woff2' => ['font-weight' => '400', 'font-style' => 'normal'],
            'Shan-Italic.woff2' => ['font-weight' => '400', 'font-style' => 'italic'],
            'Shan-Bold.woff2' => ['font-weight' => '700', 'font-style' => 'normal'],
            'Shan-BoldItalic.woff2' => ['font-weight' => '700', 'font-style' => 'italic'],
            'Shan-Black.woff2' => ['font-weight' => '900', 'font-style' => 'normal'],
            'Shan-BlackItalic.woff2' => ['font-weight' => '900', 'font-style' => 'italic'],
        ];

        $fontsToLoad = $selectedFonts ? array_intersect_key($allFonts, array_flip($selectedFonts)) : $allFonts;
        $fallbackCss = $this->generateFontFaceCss($fontsToLoad, $fontPath);

        $script = "
        (function() {
            // Check if CDN fonts loaded successfully
            var link = document.querySelector('link[href*=\"cdn.jsdelivr.net\"]');
            if (link) {
                link.onerror = function() {
                    // CDN failed, load local fonts
                    var style = document.createElement('style');
                    style.textContent = " . json_encode($fallbackCss) . ";
                    document.head.appendChild(style);
                };
            }
        })();";

        $document->addScriptDeclaration($script);
    }
}