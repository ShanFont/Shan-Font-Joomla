<?php
/**
 * @package     Shan Font Plugin
 * @subpackage  System
 * @copyright   Copyright (C) 2025 TaiDev. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\RadioField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

/**
 * Custom form field for Shan Font mode selection
 *
 * @since  1.0.0
 */
class JFormFieldShanfontmode extends RadioField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $type = 'Shanfontmode';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     * @since   1.0.0
     */
    protected function getInput()
    {
        $html = [];
        $value = $this->value ?: 'quick_setup';
        
        // Add custom CSS
        $css = '
        .shanfont-mode-selector {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin: 10px 0;
        }
        
        .shanfont-mode-option {
            position: relative;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #ffffff;
        }
        
        .shanfont-mode-option:hover {
            border-color: #007bff;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.15);
        }
        
        .shanfont-mode-option.selected {
            border-color: #007bff;
            background-color: #e7f3ff;
        }
        
        .shanfont-mode-option input[type="radio"] {
            position: absolute;
            top: 15px;
            right: 15px;
        }
        
        .shanfont-mode-title {
            font-weight: bold;
            font-size: 16px;
            color: #212529;
            margin-bottom: 5px;
            padding-right: 30px;
        }
        
        .shanfont-mode-desc {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.4;
            padding-right: 30px;
        }
        
        .shanfont-logo-header {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: #f8f9fa;
        }
        
        .shanfont-logo {
            max-width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
        
        .shanfont-title {
            font-size: 20px;
            font-weight: bold;
            color: #495057;
            margin: 5px 0;
        }
        
        .shanfont-url {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
        }
        
        .shanfont-url:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        
        .shanfont-developer {
            color: #6c757d;
            font-size: 12px;
            margin-top: 5px;
        }
        
        /* Ensure good contrast in admin themes */
        .com-plugins .shanfont-mode-title,
        .com-plugins .shanfont-title {
            color: #212529 !important;
        }
        
        .com-plugins .shanfont-mode-desc,
        .com-plugins .shanfont-developer {
            color: #6c757d !important;
        }
        
        .com-plugins .shanfont-url {
            color: #007bff !important;
        }
        ';
        
        Factory::getDocument()->addStyleDeclaration($css);
        
        // Add JavaScript for interactivity
        $js = '
        document.addEventListener("DOMContentLoaded", function() {
            const options = document.querySelectorAll(".shanfont-mode-option");
            const radios = document.querySelectorAll("input[name=\\"' . $this->name . '\\"]");
            
            function updateSelection() {
                options.forEach(function(option) {
                    const radio = option.querySelector("input[type=radio]");
                    if (radio && radio.checked) {
                        option.classList.add("selected");
                    } else {
                        option.classList.remove("selected");
                    }
                });
            }
            
            options.forEach(function(option) {
                option.addEventListener("click", function(e) {
                    if (e.target.type !== "radio") {
                        const radio = this.querySelector("input[type=radio]");
                        if (radio) {
                            radio.checked = true;
                            updateSelection();
                        }
                    }
                });
            });
            
            radios.forEach(function(radio) {
                radio.addEventListener("change", updateSelection);
            });
            
            // Initial call
            updateSelection();
        });
        ';
        
        Factory::getDocument()->addScriptDeclaration($js);
        
        // Logo header
        $logoPath = Uri::root() . 'plugins/system/shanfont/assets/ShanFont.webp';
        $html[] = '<div class="shanfont-logo-header">';
        $html[] = '<img src="' . $logoPath . '" alt="Shan Font" class="shanfont-logo">';
        $html[] = '<div class="shanfont-title">Shan Font</div>';
        $html[] = '<a href="https://shanfont.com" target="_blank" class="shanfont-url">www.shanfont.com</a>';
        $html[] = '<div class="shanfont-developer">Developed by TaiDev</div>';
        $html[] = '</div>';
        
        // Mode selector
        $html[] = '<div class="shanfont-mode-selector">';
        
        // Theme Defaults option
        $html[] = '<div class="shanfont-mode-option' . ($value === 'theme_defaults' ? ' selected' : '') . '">';
        $html[] = '<input type="radio" id="' . $this->id . '_theme" name="' . $this->name . '" value="theme_defaults"' . ($value === 'theme_defaults' ? ' checked="checked"' : '') . '>';
        $html[] = '<div class="shanfont-mode-title">' . Text::_('PLG_SYSTEM_SHANFONT_MODE_THEME_DEFAULTS') . '</div>';
        $html[] = '<div class="shanfont-mode-desc">Reset all fonts to your theme\'s default fonts. This will remove any custom Shan font styling and restore the original appearance.</div>';
        $html[] = '</div>';
        
        // Quick Setup option
        $html[] = '<div class="shanfont-mode-option' . ($value === 'quick_setup' ? ' selected' : '') . '">';
        $html[] = '<input type="radio" id="' . $this->id . '_quick" name="' . $this->name . '" value="quick_setup"' . ($value === 'quick_setup' ? ' checked="checked"' : '') . '>';
        $html[] = '<div class="shanfont-mode-title">' . Text::_('PLG_SYSTEM_SHANFONT_MODE_QUICK_SETUP') . ' <span style="color: #4caf50; font-size: 12px;">(Recommended)</span></div>';
        $html[] = '<div class="shanfont-mode-desc">Automatically apply Shan fonts to your entire website. All 8 font variants will be loaded for complete typography support.</div>';
        $html[] = '</div>';
        
        // Custom Selection option
        $html[] = '<div class="shanfont-mode-option' . ($value === 'custom_selection' ? ' selected' : '') . '">';
        $html[] = '<input type="radio" id="' . $this->id . '_custom" name="' . $this->name . '" value="custom_selection"' . ($value === 'custom_selection' ? ' checked="checked"' : '') . '>';
        $html[] = '<div class="shanfont-mode-title">' . Text::_('PLG_SYSTEM_SHANFONT_MODE_CUSTOM_SELECTION') . ' <span style="color: #ff9800; font-size: 12px;">(Advanced)</span></div>';
        $html[] = '<div class="shanfont-mode-desc">Choose specific font variants to load. This option allows you to optimize performance by loading only the fonts you need.</div>';
        $html[] = '</div>';
        
        $html[] = '</div>';
        
        return implode("\n", $html);
    }
}