# Shan Font Joomla Plugin

# Shan Font Joomla Plugin

![Shan Font Logo](assets/ShanFont.webp)

A comprehensive Joomla plugin that enables easy integration of Shan fonts into your website with automatic CDN loading, local fallback, and customizable font selection.

## Features

- **Multiple Loading Modes**: Theme Defaults, Quick Setup, and Custom Selection
- **CDN Integration**: Primary loading from jsdelivr CDN with automatic local fallback
- **8 Font Variants**: Including Thin, Regular, Bold, Black with Italic versions
- **Performance Optimized**: Font loading with `font-display: swap` for better performance
- **Responsive Design**: Works seamlessly across all devices
- **Security Focused**: Follows Joomla security best practices
- **Easy Configuration**: User-friendly admin interface

## Installation

1. Download the plugin package
2. Go to Joomla Administrator → Extensions → Manage → Install
3. Upload and install the plugin package
4. The plugin will be automatically enabled after installation

## Configuration

Navigate to **Extensions → Plugins → System - Shan Font** to configure:

### Font Modes

#### 1. Theme Defaults
- Resets all fonts to your theme's default fonts
- Removes any custom Shan font styling
- Useful for temporarily disabling Shan fonts

#### 2. Quick Setup (Default)
- Automatically applies Shan fonts to your entire website
- Loads all 8 font variants
- Uses CDN with local fallback
- Recommended for most users

#### 3. Custom Selection
- Choose specific font variants to load
- Reduces file size by loading only needed fonts
- Advanced users can select from:
  - Shan Thin
  - Shan Thin Italic
  - Shan Regular
  - Shan Italic
  - Shan Bold
  - Shan Bold Italic
  - Shan Black
  - Shan Black Italic

### CDN Options

- **Use CDN**: Enable/disable CDN loading (enabled by default)
- **CDN URL**: `https://cdn.jsdelivr.net/gh/ShanFont/ShanFont@main/shan.css`
- **Fallback**: Automatic local font loading if CDN fails

## Font Variants

The plugin includes 8 professional Shan font variants:

| Variant | Weight | Style | File |
|---------|--------|-------|------|
| Thin | 100 | Normal | Shan-Thin.woff2 |
| Thin Italic | 100 | Italic | Shan-ThinItalic.woff2 |
| Regular | 400 | Normal | Shan-Regular.woff2 |
| Italic | 400 | Italic | Shan-Italic.woff2 |
| Bold | 700 | Normal | Shan-Bold.woff2 |
| Bold Italic | 700 | Italic | Shan-BoldItalic.woff2 |
| Black | 900 | Normal | Shan-Black.woff2 |
| Black Italic | 900 | Italic | Shan-BlackItalic.woff2 |

## CSS Utility Classes

The plugin provides additional CSS utility classes for advanced styling:

### Font Weight Classes
```css
.shan-thin          /* Thin weight */
.shan-regular       /* Regular weight */
.shan-bold          /* Bold weight */
.shan-black         /* Black weight */
```

### Font Style Classes
```css
.shan-italic        /* Italic style */
.shan-bold-italic   /* Bold + Italic */
```

### Utility Classes
```css
.shan-font          /* Apply Shan font */
.no-shan-font      /* Remove Shan font */
```

### Responsive Classes
```css
.shan-text-sm       /* Small text */
.shan-text-lg       /* Large text */
.shan-mobile-center /* Center on mobile */
```

## File Structure

```
plugins/system/shanfont/
├── assets/
│   └── ShanFont.webp
├── fonts/
│   ├── Shan-Thin.woff2
│   ├── Shan-ThinItalic.woff2
│   ├── Shan-Regular.woff2
│   ├── Shan-Italic.woff2
│   ├── Shan-Bold.woff2
│   ├── Shan-BoldItalic.woff2
│   ├── Shan-Black.woff2
│   └── Shan-BlackItalic.woff2
├── language/
│   └── en-GB/
│       ├── plg_system_shanfont.ini
│       └── plg_system_shanfont.sys.ini
├── tmpl/
│   └── default.php
├── shanfont.php
├── shanfont.xml
├── script.php
└── README.md
```

## Technical Details

### Performance Features
- **Font Display Swap**: Ensures text remains visible during font load
- **WOFF2 Format**: Modern, compressed font format for faster loading
- **Conditional Loading**: Only loads selected fonts in custom mode
- **CDN Fallback**: Automatic failover to local fonts

### Security Features
- **Input Validation**: All user inputs are properly sanitized
- **XSS Protection**: Output is properly escaped
- **SQL Injection Prevention**: Uses Joomla's database abstraction layer
- **Access Control**: Admin-only configuration access

### Browser Support
- Modern browsers supporting WOFF2 (95%+ browser support)
- Automatic fallback to system fonts if Shan fonts fail to load
- Cross-platform compatibility (Windows, macOS, Linux, mobile)

## Requirements

- **Joomla**: 4.0.0 or later
- **PHP**: 7.4.0 or later
- **Browser**: Modern browser with WOFF2 support

## Troubleshooting

### Fonts Not Loading
1. Check if plugin is enabled: Extensions → Plugins → System - Shan Font
2. Verify mode is set to "Quick Setup" or "Custom Selection"
3. Clear Joomla cache: System → Clear Cache
4. Check browser developer tools for font loading errors

### CDN Issues
1. Disable CDN in plugin settings to use local fonts only
2. Check network connectivity to jsdelivr.net
3. Verify firewall/security software isn't blocking CDN requests

### Performance Issues
1. Use "Custom Selection" mode to load only needed font variants
2. Enable Gzip compression on your server
3. Consider using a CDN for your entire website

## Changelog

### Version 1.0.0
- Initial release
- Support for 8 Shan font variants
- CDN integration with local fallback
- Three configuration modes
- Responsive design support
- Performance optimizations

## Support

- **Website**: [https://shanfont.com](https://shanfont.com)
- **Developer**: Yord
- **License**: GNU General Public License version 2 or later

## License

This plugin is released under the GNU General Public License version 2 or later. See the LICENSE file for details.

---

**Developed by Yord** | **© 2025 All Rights Reserved**

## License
This plugin is licensed under the GPLv2 or later.