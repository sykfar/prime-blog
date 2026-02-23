=== Prime Blog ===
Contributors: Alexander Sorge
Tags: blog, custom-colors, custom-logo, custom-menu, editor-style, featured-images, rtl-language-support
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 8.0
Stable tag: 1.0.3
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A clean, modern blog theme featuring DM Sans typography, configurable category colours, responsive post card grid, and dark/light mode support.

== Description ==

Prime Blog is a lightweight, fully responsive WordPress theme built for content-first blogging. It features:

* Configurable per-category badge and archive colours via the WordPress Customizer
* Dark mode / light mode toggle with localStorage persistence
* Responsive post card grid (2 or 3 columns, configurable)
* Reading progress bar on single posts
* Author bio box, related posts, and share bar on single posts
* Seven Google Font options selectable in the Customizer
* WordPress Customizer support for colours, typography, and layout

== Installation ==

1. Upload the `prime-blog` folder to `/wp-content/themes/`
2. Activate the theme in **Appearance → Themes**
3. Go to **Appearance → Customize → Prime Blog** to configure colours and layout
4. Assign categories to posts — each category has a configurable colour

== Changelog ==

= 1.0.3 =
* Accessibility: touch targets increased to 44×44px (WCAG 2.5.5) for dark-mode toggle, hamburger, pagination, and social icons
* Responsive: table overflow-x scroll on mobile prevents horizontal page scroll
* Responsive: overflow-wrap: break-word on article content prevents URL overflow
* Responsive: new 600px breakpoint for phablets, 360px breakpoint for ultra-small phones
* Responsive: fluid title sizing via clamp() on small screens
* Responsive: share buttons enlarge to 40px on mobile for easier tapping

= 1.0.2 =
* Fix: move dark-mode inline script to wp_head hook (Theme Check compliance)

= 1.0.1 =
* Performance: non-blocking Google Fonts loading (preload/onload pattern)
* Performance: transient cache for dynamic Customizer CSS output
* Performance: static cache for get_categories() – one DB query per request
* Performance: hero image fetchpriority=high for improved LCP
* Performance: merged extra.css into main.css (one fewer HTTP request)
* Performance: dark-mode script applied before first paint to prevent FOUC

= 1.0.0 =
* Initial release

== Copyright ==

Prime Blog WordPress Theme, Copyright (C) 2026 Alexander
Prime Blog is distributed under the terms of the GNU GPL v2 or later.

This theme bundles the following third-party resources:

* DM Sans font, Copyright 2019 Indian Type Foundry
  License: SIL Open Font License 1.1
  Source: https://fonts.google.com/specimen/DM+Sans

* Normalize.css, Copyright 2012-2016 Nicolas Gallagher and Jonathan Neal
  License: MIT
  Source: https://necolas.github.io/normalize.css/
