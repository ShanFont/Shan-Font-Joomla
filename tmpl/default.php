<?php
/**
 * @package     Shan Font Plugin
 * @subpackage  System
 * @copyright   Copyright (C) 2025 TaiDev. All rights reserved.
 * @license     GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();
$doc = $app->getDocument();

// Add custom CSS for the plugin configuration
$css = '
.shanfont-config {
    background: #ffffff;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.shanfont-header {
    text-align: center;
    padding: 20px;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    margin-bottom: 20px;
    background: #f8f9fa;
}

.shanfont-logo {
    max-width: 120px;
    height: auto;
    margin-bottom: 15px;
}

.shanfont-title {
    font-size: 24px;
    font-weight: bold;
    color: #495057;
    margin: 10px 0;
}

.shanfont-url {
    color: #007bff;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
}

.shanfont-url:hover {
    color: #0056b3;
    text-decoration: underline;
}

.shanfont-developer {
    color: #6c757d;
    font-size: 14px;
    margin-top: 5px;
}

.shanfont-description {
    padding: 15px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    color: #495057;
    line-height: 1.5;
}

.shanfont-modes {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.shanfont-mode {
    padding: 15px;
    border: 2px solid #dee2e6;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: #ffffff;
}

.shanfont-mode:hover {
    border-color: #007bff;
    background-color: #f8f9fa;
}

.shanfont-mode.active {
    border-color: #007bff;
    background-color: #e7f3ff;
}

.shanfont-mode-title {
    font-weight: bold;
    font-size: 16px;
    color: #495057;
    margin-bottom: 5px;
}

.shanfont-mode-desc {
    color: #6c757d;
    font-size: 14px;
}

.shanfont-custom-fonts {
    margin-top: 15px;
    display: none;
    padding: 15px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 5px;
}

.shanfont-custom-fonts.show {
    display: block;
}

.font-checkbox {
    margin: 8px 0;
}

.font-checkbox label {
    margin-left: 8px;
    font-weight: normal;
    color: #495057;
}

.shanfont-actions {
    text-align: center;
    padding: 20px 0;
    margin-top: 20px;
    border-top: 1px solid #dee2e6;
}

.btn-shanfont {
    background: #007bff;
    color: white;
    border: none;
    padding: 12px 30px;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn-shanfont:hover {
    background: #0056b3;
}

/* Force text colors for better contrast in all admin themes */
.shanfont-config * {
    color: inherit;
}

.shanfont-title {
    color: #495057 !important;
}

.shanfont-developer {
    color: #6c757d !important;
}

.shanfont-url {
    color: #007bff !important;
}

.shanfont-description {
    color: #495057 !important;
}

@media (max-width: 768px) {
    .shanfont-config {
        margin: 10px;
        padding: 15px;
    }
}
';

$doc->addStyleDeclaration($css);

// Add JavaScript for interactive functionality
$js = '
document.addEventListener("DOMContentLoaded", function() {
    const modeRadios = document.querySelectorAll("input[name=\"jform[params][font_mode]\"]");
    const customFontsSection = document.querySelector(".shanfont-custom-fonts");
    
    function updateModeDisplay() {
        const selectedMode = document.querySelector("input[name=\"jform[params][font_mode]\"]:checked");
        if (selectedMode && customFontsSection) {
            if (selectedMode.value === "custom_selection") {
                customFontsSection.classList.add("show");
            } else {
                customFontsSection.classList.remove("show");
            }
        }
    }
    
    modeRadios.forEach(function(radio) {
        radio.addEventListener("change", updateModeDisplay);
    });
    
    // Initial call
    updateModeDisplay();
});
';

$doc->addScriptDeclaration($js);
?>

<div class="shanfont-config">
    <div class="shanfont-header">
        <img src="<?php echo Uri::root(); ?>plugins/system/shanfont/assets/ShanFont.webp" 
             alt="Shan Font" class="shanfont-logo">
        <h2 class="shanfont-title"><?php echo Text::_('PLG_SYSTEM_SHANFONT'); ?></h2>
        <a href="https://shanfont.com" target="_blank" class="shanfont-url">www.shanfont.com</a>
        <div class="shanfont-developer">Developed by TaiDev</div>
    </div>
    
    <div class="shanfont-description">
        <p><?php echo Text::_('PLG_SYSTEM_SHANFONT_XML_DESCRIPTION'); ?></p>
    </div>
</div>