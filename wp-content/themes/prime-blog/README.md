# Prime Blog

A clean, modern WordPress blog theme featuring DM Sans typography, configurable category colours, responsive post card grid, and dark/light mode support.

**Version:** 1.0.4 | **License:** GPL v2 or later | **Requires WordPress:** 6.0+ | **Requires PHP:** 8.0+

---

## Features

- **Dark / Light mode** — toggle with localStorage persistence and FOUC prevention
- **Configurable category colours** — each category gets a colour picker in the Customizer; used for badges and archive headers
- **Responsive post card grid** — 1, 2, or 3 columns, configurable in the Customizer
- **Reading progress bar** — shown on single posts
- **Author bio box** — displayed below post content
- **Related posts** — by category, shown on single posts
- **Social share bar** — 9 networks (Twitter/X, Facebook, LinkedIn, WhatsApp, Telegram, Reddit, Pinterest, Email, Copy link); each toggle-able via Customizer
- **Seven Google Fonts** — selectable via Customizer
- **WCAG 2.5.5 touch targets** — all interactive elements ≥ 44×44px on mobile
- **Block editor support** — block styles, block patterns, and editor styles included
- **Comments** — full `comments.php` with `wp_list_comments`, `comment_form`, and pagination
- **Print styles** — hides navigation, sidebar, share bar, and related posts when printing

---

## Installation

1. Download the latest ZIP from [Releases](https://github.com/sykfar/prime-blog/releases)
2. In WordPress go to **Appearance → Themes → Add New → Upload Theme**
3. Upload the ZIP and click **Activate**
4. Go to **Appearance → Customize → Prime Blog** to configure colours, typography, and layout

---

## Customizer Options

| Section | Options |
|---|---|
| Colors – Light | Background, card background, text, accent, link |
| Colors – Dark | Same set for dark mode |
| Category Colors | One colour picker per category (auto-discovered) |
| Typography | Font family (7 options), base font size |
| Layout | Grid columns desktop (2 or 3), tablet (1 or 2), content width |
| Share Buttons | Master toggle + per-network enable/disable |

---

## File Structure

```
prime-blog/
├── assets/
│   ├── css/
│   │   ├── main.css          # All theme styles
│   │   └── editor-style.css  # Block editor styles
│   └── js/
│       ├── main.js           # Dark mode toggle, mobile nav, share bar
│       └── customizer.js     # Live Customizer preview
├── comments.php
├── footer.php
├── functions.php             # Theme setup, Customizer, enqueues
├── header.php
├── index.php
├── page.php
├── searchform.php
├── single.php
├── style.css                 # Theme header
└── readme.txt                # WordPress.org readme
```

---

## Changelog

### 1.0.4
- Fix: Customizer grid CSS now wrapped in `@media (min-width: 1025px)` — no longer breaks responsive layout on mobile/tablet
- Feature: new **"Posts per row – Tablet"** Customizer control (1 or 2 columns, 601–1024 px)
- Fix: Customizer live preview now uses `<style>` injection with proper media queries instead of `element.style` (which bypassed all breakpoints)
- Mobile (≤ 600 px) always shows 1 column regardless of any setting

### 1.0.3
- Accessibility: touch targets increased to 44×44px (WCAG 2.5.5) for dark-mode toggle, hamburger, pagination, and social icons
- Responsive: table overflow-x scroll on mobile prevents horizontal page scroll
- Responsive: `overflow-wrap: break-word` on article content prevents URL overflow
- Responsive: new 600px breakpoint for phablets, 360px breakpoint for ultra-small phones
- Responsive: fluid title sizing via `clamp()` on small screens
- Responsive: share buttons enlarge to 40px on mobile for easier tapping

### 1.0.2
- Fix: move dark-mode inline script to `wp_head` hook (Theme Check compliance)

### 1.0.1
- Performance: non-blocking Google Fonts loading (preload/onload pattern)
- Performance: transient cache for dynamic Customizer CSS output
- Performance: static cache for `get_categories()` — one DB query per request
- Performance: hero image `fetchpriority=high` for improved LCP
- Performance: merged extra.css into main.css (one fewer HTTP request)
- Performance: dark-mode script applied before first paint to prevent FOUC

### 1.0.0
- Initial release

---

## License

Prime Blog WordPress Theme, Copyright (C) 2026 Alexander
Distributed under the [GNU General Public License v2 or later](https://www.gnu.org/licenses/gpl-2.0.html).

### Bundled Resources

- **DM Sans** — Copyright 2019 Indian Type Foundry, [SIL Open Font License 1.1](https://scripts.sil.org/OFL)
- **Normalize.css** — Copyright 2012–2016 Nicolas Gallagher and Jonathan Neal, [MIT License](https://opensource.org/licenses/MIT)
