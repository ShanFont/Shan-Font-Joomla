# Shan Font Joomla Plugin
![Shan Font Joomla Plugin](https://shanfont.com/wp-content/uploads/2025/07/shan-font-on-joomla-1248x702.jpg)
A comprehensive Joomla plugin that enables easy integration of Shan fonts into your website with automatic CDN loading, local fallback, and customizable font selection.

**Official Extension Page:** https://extensions.joomla.org/extension/shan-font/

## Description

The Shan Font plugin provides seamless integration of authentic Shan typography into your Joomla website. Designed specifically for Shan-speaking communities and cultural organizations, this plugin offers three distinct font modes with performance optimization and security best practices.

## Key Features

- **Multiple Loading Modes**: Theme Defaults, Quick Setup, and Custom Selection
- **CDN Integration**: Primary loading from jsdelivr CDN with automatic local fallback
- **8 Font Variants**: Including Thin, Regular, Bold, Black with Italic versions
- **Performance Optimized**: Font loading with `font-display: swap` for better performance
- **Responsive Design**: Works seamlessly across all devices
- **Security Focused**: Follows Joomla security best practices
- **Easy Configuration**: User-friendly admin interface

## Installation

### Automatic Installation (Recommended)

The easiest way to install Shan Font is directly from the official Joomla Extensions Directory:

1. Go to **Extensions → Install Extensions** in your Joomla administrator
2. Click on **Install from Web** tab
3. Search for "Shan Font" or visit: https://extensions.joomla.org/extension/shan-font/
4. Click **Install** and the plugin will be automatically downloaded and installed
5. The plugin will be automatically enabled after installation

### Alternative Installation Methods

#### From Joomla Extensions Directory
1. Visit the official extension page: https://extensions.joomla.org/extension/shan-font/
2. Click **Download** to get the latest stable version
3. In your Joomla admin, go to **Extensions → Install Extensions**
4. Choose the downloaded ZIP file under **Upload Package File**
5. Click **Upload & Install**

#### Manual Installation
1. Download the plugin package from https://extensions.joomla.org/extension/shan-font/
2. Extract the files to your server
3. Upload to the `/plugins/system/shanfont/` directory
4. Install through **Extensions → Install Extensions → Install from Folder**

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

## Technical Specifications

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

## System Requirements

- **Joomla**: 4.0.0 or later
- **PHP**: 7.4.0 or later
- **Browser**: Modern browser with WOFF2 support

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

## Frequently Asked Questions

**Q: Will this plugin slow down my website?**  
A: No! The plugin is performance-optimized and uses modern loading techniques. It employs font-display: swap and only loads selected font variants to minimize impact.

**Q: Can I use this with any Joomla template?**  
A: Yes! The plugin is designed to work with any properly coded Joomla template. The "Theme Defaults" mode ensures maximum compatibility.

**Q: Do I need to upload font files manually?**  
A: No, all necessary Shan font files are included with the plugin installation.

**Q: What if the CDN is unavailable?**  
A: The plugin automatically falls back to local font files if the CDN is unreachable, ensuring your fonts always work.

**Q: Can I customize which elements use Shan fonts?**  
A: Yes, the "Custom Selection" mode allows you to choose specific font weights, and you can use CSS utility classes for fine-grained control.

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
- Full Joomla coding standards compliance
- Security best practices implementation

## Contributing

We welcome contributions! Please:
1. Fork the repository
2. Create a feature branch
3. Follow Joomla coding standards
4. Submit a pull request with detailed description

## Support

- **Official Extension Page**: https://extensions.joomla.org/extension/shan-font/
- **Official Project Page**: https://shanfont.com/
- **Developer**: TaiDev
- **Rate & Review**: Help others by leaving a review on the official extension page

## License

This plugin is released under the GNU General Public License version 2 or later. See the LICENSE file for details.

**Developed by Yord** | **© 2025 All Rights Reserved**
