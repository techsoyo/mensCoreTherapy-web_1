---
description: Repository Information Overview
alwaysApply: true
---

# MensCore Therapy WordPress Theme

## Summary

Custom WordPress theme for MensCore Therapy, a massage therapy and wellness business. The theme features a modern design with interactive elements, smooth animations, and responsive layout.

## Structure

- **assets/**: Contains all theme assets (CSS, JS, images)
  - **css/**: Organized using ITCSS methodology (base, components, pages, utilities)
  - **js/**: JavaScript files for main functionality and page-specific features
  - **images/**: Theme images and graphics
- **template-parts/**: Template files for different sections (home, masajes, contacto, etc.)
- **Root files**: Core WordPress theme files (functions.php, header.php, footer.php, etc.)

## Language & Runtime

**Language**: PHP, JavaScript, CSS
**WordPress Version**: Compatible with WordPress 5.x+
**Build System**: None (direct file inclusion)
**Package Manager**: None (dependencies loaded via CDN)

## Dependencies

**Main Dependencies**:

- WordPress Core
- jQuery (loaded by WordPress)
- Font Awesome 6.0.0 (loaded via CDN)

## Theme Features

**Custom Post Types**:

- Productos (products) with custom meta fields for price, icon, and benefits

**Template Structure**:

- Modular template parts for different sections
- Page-specific templates with dedicated styling

**CSS Architecture**:

- ITCSS methodology (Inverted Triangle CSS)
- Organized in base, components, pages, and utilities

## JavaScript Components

**Main Features**:

- Mobile navigation with toggle functionality
- Smooth scroll for anchor links
- Scroll-based animations using IntersectionObserver
- Enhanced hover effects with optimized performance
- WhatsApp integration for direct messaging
- Sticky header with scroll-aware behavior
- Sticky footer with inverse scroll behavior

## Asset Loading

**Enqueuing Strategy**:

```php
// Global assets
wp_enqueue_style('theme-style', get_stylesheet_uri());
wp_enqueue_script('theme-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);

// Page-specific assets
if (is_page('masajes')) {
    wp_enqueue_style('masajes-css', get_template_directory_uri() . '/assets/css/pages/_masajes.css');
    wp_enqueue_script('masajes-js', get_template_directory_uri() . '/assets/js/masajes.js');
}
```

## Custom Fields

**Product Meta Fields**:

- Price: Product pricing information
- Icon: Font Awesome icon reference
- Benefits: List of product benefits (one per line)

## Development

**Local Environment**:

- Local by Flywheel (based on directory structure)
- Direct file editing (no build process)
