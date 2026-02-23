/**
 * Prime Blog – Customizer Live Preview
 *
 * Uses postMessage transport to apply setting changes instantly in the
 * Customizer preview pane without a full page reload.
 */
(function () {
    'use strict';

    const root   = document.documentElement;
    const fonts  = (window.primeBlogCustomizer || {}).fonts        || {};
    const apiBase = (window.primeBlogCustomizer || {}).fontsApiBase || 'https://fonts.googleapis.com/css2?family=';

    /* -----------------------------------------------------------------------
       Style injection helpers
       We maintain a single <style> element for all live overrides so we can
       cleanly update :root and [data-theme="dark"] independently.
    ----------------------------------------------------------------------- */
    let lightVars = {};
    let darkVars  = {};

    function getOrCreateStyle() {
        let el = document.getElementById('prime-blog-customizer-live');
        if (!el) {
            el = document.createElement('style');
            el.id = 'prime-blog-customizer-live';
            document.head.appendChild(el);
        }
        return el;
    }

    function rebuildLiveStyles() {
        const style = getOrCreateStyle();
        let css = ':root{';
        for (const [prop, val] of Object.entries(lightVars)) {
            css += `${prop}:${val};`;
        }
        css += '}[data-theme="dark"]{';
        for (const [prop, val] of Object.entries(darkVars)) {
            css += `${prop}:${val};`;
        }
        css += '}';
        style.textContent = css;
    }

    /** Set a CSS custom property on :root */
    function setLight(prop, val) {
        lightVars[prop] = val;
        rebuildLiveStyles();
    }

    /** Set a CSS custom property scoped to [data-theme="dark"] */
    function setDark(prop, val) {
        darkVars[prop] = val;
        rebuildLiveStyles();
    }

    /** Derive a darker shade of a hex color */
    function darkenHex(hex, amount) {
        hex = hex.replace('#', '');
        if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
        const r = Math.max(0, parseInt(hex.slice(0, 2), 16) - amount);
        const g = Math.max(0, parseInt(hex.slice(2, 4), 16) - amount);
        const b = Math.max(0, parseInt(hex.slice(4, 6), 16) - amount);
        return '#' + [r, g, b].map(v => v.toString(16).padStart(2, '0')).join('');
    }

    /** Derive a lighter shade of a hex color */
    function lightenHex(hex, amount) {
        hex = hex.replace('#', '');
        if (hex.length === 3) hex = hex.split('').map(c => c + c).join('');
        const r = Math.min(255, parseInt(hex.slice(0, 2), 16) + amount);
        const g = Math.min(255, parseInt(hex.slice(2, 4), 16) + amount);
        const b = Math.min(255, parseInt(hex.slice(4, 6), 16) + amount);
        return '#' + [r, g, b].map(v => v.toString(16).padStart(2, '0')).join('');
    }

    /* -----------------------------------------------------------------------
       Helper: dynamically load a Google Font <link> into the preview pane
    ----------------------------------------------------------------------- */
    function loadGoogleFont(query) {
        const id  = 'prime-blog-live-font';
        let   link = document.getElementById(id);
        if (!link) {
            link = document.createElement('link');
            link.id  = id;
            link.rel = 'stylesheet';
            document.head.appendChild(link);
        }
        link.href = apiBase + encodeURIComponent(query).replace(/%2B/g, '+').replace(/%3B/g, ';').replace(/%40/g, '@').replace(/%2C/g, ',').replace(/%2E/g, '.') + '&display=swap';
    }

    /* -----------------------------------------------------------------------
       Bind settings → CSS variable / DOM updates
    ----------------------------------------------------------------------- */
    const { customize } = wp;

    // ── Light Mode Colors ───────────────────────────────────────────────────

    customize('prime_accent', function (value) {
        value.bind(function (v) {
            setLight('--accent',       v);
            setLight('--accent-dark',  darkenHex(v, 30));
            setLight('--accent-light', lightenHex(v, 40));
        });
    });

    customize('prime_bg', function (value) {
        value.bind(function (v) { setLight('--bg', v); });
    });

    customize('prime_bg_soft', function (value) {
        value.bind(function (v) { setLight('--bg-soft', v); });
    });

    customize('prime_card_bg', function (value) {
        value.bind(function (v) { setLight('--card-bg', v); });
    });

    customize('prime_text', function (value) {
        value.bind(function (v) { setLight('--text', v); });
    });

    customize('prime_text_muted', function (value) {
        value.bind(function (v) { setLight('--text-muted', v); });
    });

    customize('prime_text_subtle', function (value) {
        value.bind(function (v) { setLight('--text-subtle', v); });
    });

    customize('prime_border', function (value) {
        value.bind(function (v) { setLight('--border', v); });
    });

    customize('prime_link', function (value) {
        value.bind(function (v) {
            setLight('--link', v);
            setLight('--link-hover', darkenHex(v, 28));
        });
    });

    // ── Dark Mode Colors ────────────────────────────────────────────────────

    customize('prime_dark_bg', function (value) {
        value.bind(function (v) { setDark('--bg', v); });
    });

    customize('prime_dark_bg_soft', function (value) {
        value.bind(function (v) { setDark('--bg-soft', v); });
    });

    customize('prime_dark_card_bg', function (value) {
        value.bind(function (v) { setDark('--card-bg', v); });
    });

    customize('prime_dark_text', function (value) {
        value.bind(function (v) { setDark('--text', v); });
    });

    customize('prime_dark_text_muted', function (value) {
        value.bind(function (v) { setDark('--text-muted', v); });
    });

    customize('prime_dark_text_subtle', function (value) {
        value.bind(function (v) { setDark('--text-subtle', v); });
    });

    customize('prime_dark_border', function (value) {
        value.bind(function (v) { setDark('--border', v); });
    });

    // ── Typography ──────────────────────────────────────────────────────────

    customize('prime_font_family', function (value) {
        value.bind(function (v) {
            const fontData = fonts[v];
            if (!fontData) return;
            // 1. Load the Google Font into the preview pane
            loadGoogleFont(fontData.query);
            // 2. Update the CSS variable
            setLight('--font', fontData.stack);
        });
    });

    customize('prime_base_font_size', function (value) {
        value.bind(function (v) {
            document.body.style.fontSize = parseInt(v, 10) + 'px';
        });
    });

    // ── Category Colors ─────────────────────────────────────────────────────
    // All categories are passed from PHP via wp_localize_script so new
    // categories are automatically covered without touching this file.

    const categories = (window.primeBlogCustomizer || {}).categories || [];

    categories.forEach(function (cat) {
        customize(cat.setting, function (value) {
            value.bind(function (newVal) {
                // Update --cat-{slug} on :root; badges pick it up instantly
                // because their CSS rule reads var(--cat-{slug}) via --cat.
                setLight(cat.cssVar, newVal);
                rebuildCategoryArchiveStyles();
            });
        });
    });

    /** Rebuild archive-page accent rules for every category */
    function rebuildCategoryArchiveStyles() {
        let css = '';

        categories.forEach(function (cat) {
            const color = lightVars[cat.cssVar]
                       || getComputedStyle(root).getPropertyValue(cat.cssVar).trim()
                       || 'currentColor';
            const slug  = cat.slug;

            css += `.post-tag[data-cat="${slug}"]{--cat:${color};}`;
            css += `body.category-${slug} .hero-tag,`;
            css += `body.category-${slug} .section-label{color:${color};}`;
            css += `body.category-${slug} .page-hero{border-bottom-color:${color}40;}`;
            css += `body.tag-${slug} .hero-tag{color:${color};}`;
        });

        let archiveStyle = document.getElementById('prime-blog-customizer-archive');
        if (!archiveStyle) {
            archiveStyle = document.createElement('style');
            archiveStyle.id = 'prime-blog-customizer-archive';
            document.head.appendChild(archiveStyle);
        }
        archiveStyle.textContent = css;
    }

    // ── Share Buttons ───────────────────────────────────────────────────────

    const shareNetworks = (window.primeBlogCustomizer || {}).shareNetworks || [];

    // Master toggle – show/hide the entire share bar
    customize('prime_share_enabled', function (value) {
        value.bind(function (v) {
            document.querySelectorAll('.share-bar').forEach(function (bar) {
                bar.style.display = v ? '' : 'none';
            });
        });
    });

    // Per-network toggles – show/hide individual buttons
    shareNetworks.forEach(function (net) {
        customize(net.setting, function (value) {
            value.bind(function (v) {
                document.querySelectorAll('.share-btn[data-share="' + net.id + '"]').forEach(function (btn) {
                    btn.style.display = v ? 'inline-flex' : 'none';
                });
            });
        });
    });

    // ── Layout ──────────────────────────────────────────────────────────────

    customize('prime_grid_cols', function (value) {
        value.bind(function (v) {
            const cols = v === '2' ? 2 : 3;
            document.querySelectorAll('.posts-grid').forEach(function (grid) {
                grid.style.gridTemplateColumns = 'repeat(' + cols + ', 1fr)';
            });
        });
    });

    customize('prime_card_radius', function (value) {
        value.bind(function (v) {
            setLight('--radius-lg', parseInt(v, 10) + 'px');
        });
    });

    customize('prime_container_width', function (value) {
        value.bind(function (v) {
            setLight('--container', parseInt(v, 10) + 'px');
        });
    });

})();
