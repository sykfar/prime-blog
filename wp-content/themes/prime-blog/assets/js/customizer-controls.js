/**
 * Prime Blog – Customizer Controls enhancements
 *
 * Adds a live numeric readout next to every range input so the user can
 * see the exact pixel value while dragging the slider.
 */
(function () {
    'use strict';

    wp.customize.bind('ready', function () {

        // ── Range slider value display ──────────────────────────────────────
        document.querySelectorAll('.customize-control input[type="range"]').forEach(function (range) {
            const wrap   = range.closest('.customize-control');
            const suffix = range.dataset.suffix || 'px';

            // Create the readout badge
            const badge = document.createElement('span');
            badge.className = 'prime-range-value';
            badge.style.cssText = [
                'display:inline-block',
                'margin-left:8px',
                'padding:1px 8px',
                'border-radius:4px',
                'background:var(--wp-admin-theme-color,#3858e9)',
                'color:#fff',
                'font-size:11px',
                'font-weight:600',
                'font-family:monospace',
                'line-height:20px',
                'vertical-align:middle',
            ].join(';');

            badge.textContent = range.value + suffix;

            // Insert after the range input
            range.insertAdjacentElement('afterend', badge);

            // Update on drag
            range.addEventListener('input', function () {
                badge.textContent = range.value + suffix;
            });
        });

        // ── Font family preview ─────────────────────────────────────────────
        // Show a small "The quick brown fox" sample in the selected font
        const fontControl = document.querySelector('[id$="prime_font_family"] select');
        if (fontControl) {
            const preview = document.createElement('p');
            preview.className = 'prime-font-preview';
            preview.style.cssText = [
                'margin:8px 0 0',
                'font-size:15px',
                'line-height:1.5',
                'color:#1e1e1e',
                'background:#f9f9f9',
                'border:1px solid #ddd',
                'border-radius:4px',
                'padding:8px 10px',
                'transition:font-family .3s',
            ].join(';');
            preview.textContent = 'The quick brown fox jumps over the lazy dog.';

            fontControl.closest('.customize-control').appendChild(preview);

            function updateFontPreview(fontName) {
                // Dynamically load into the controls pane
                const linkId = 'prime-controls-font-' + fontName.replace(/\s/g, '-').toLowerCase();
                if (!document.getElementById(linkId)) {
                    const data = (window.primeBlogCustomizer || {}).fonts || {};
                    const fontData = data[fontName];
                    if (fontData) {
                        const link = document.createElement('link');
                        link.id   = linkId;
                        link.rel  = 'stylesheet';
                        link.href = 'https://fonts.googleapis.com/css2?family=' + fontData.query + '&display=swap';
                        document.head.appendChild(link);
                    }
                }
                preview.style.fontFamily = fontName;
            }

            // Initial state
            updateFontPreview(fontControl.value);

            fontControl.addEventListener('change', function () {
                updateFontPreview(this.value);
            });
        }

    });

})();
