<?php
/**
 * Prime Blog – functions and definitions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'PRIME_BLOG_VERSION', '1.0.4' );
define( 'PRIME_BLOG_DIR', get_template_directory() );
define( 'PRIME_BLOG_URI', get_template_directory_uri() );

/* -----------------------------------------------------------------------
 * Theme setup
 * --------------------------------------------------------------------- */
function prime_blog_setup() {
    load_theme_textdomain( 'prime-blog', PRIME_BLOG_DIR . '/languages' );

    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ] );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'assets/css/editor-style.css' );

    add_theme_support( 'custom-header', [
        'default-image'      => '',
        'default-text-color' => '111111',
        'width'              => 1400,
        'height'             => 400,
        'flex-width'         => true,
        'flex-height'        => true,
    ] );

    add_theme_support( 'custom-background', [
        'default-color' => 'ffffff',
        'default-image' => '',
    ] );

    // Custom image sizes
    add_image_size( 'prime-card',   760, 480, true );
    add_image_size( 'prime-hero',  1400, 600, true );
    add_image_size( 'prime-thumb',  120, 120, true );

    // Navigation menus
    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'prime-blog' ),
        'footer'  => __( 'Footer Navigation',  'prime-blog' ),
    ] );
}
add_action( 'after_setup_theme', 'prime_blog_setup' );

/* -----------------------------------------------------------------------
 * Block styles
 * --------------------------------------------------------------------- */
function prime_blog_register_block_styles(): void {
    register_block_style( 'core/button', [
        'name'  => 'prime-outline',
        'label' => __( 'Outline', 'prime-blog' ),
    ] );
    register_block_style( 'core/quote', [
        'name'  => 'prime-highlight',
        'label' => __( 'Highlighted', 'prime-blog' ),
    ] );
    register_block_style( 'core/image', [
        'name'  => 'prime-rounded',
        'label' => __( 'Rounded', 'prime-blog' ),
    ] );
}
add_action( 'init', 'prime_blog_register_block_styles' );

/* -----------------------------------------------------------------------
 * Block patterns
 * --------------------------------------------------------------------- */
function prime_blog_register_block_patterns(): void {
    register_block_pattern_category( 'prime-blog', [ 'label' => __( 'Prime Blog', 'prime-blog' ) ] );

    register_block_pattern( 'prime-blog/hero-cta', [
        'title'      => __( 'Hero with CTA', 'prime-blog' ),
        'categories' => [ 'prime-blog' ],
        'content'    => '<!-- wp:group {"className":"prime-hero-pattern","layout":{"type":"constrained"}} --><div class="wp-block-group prime-hero-pattern"><!-- wp:heading {"level":1} --><h1>' . esc_html__( 'Welcome to Prime Blog', 'prime-blog' ) . '</h1><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'A clean, modern blog theme for content creators.', 'prime-blog' ) . '</p><!-- /wp:paragraph --><!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button --><div class="wp-block-button"><a class="wp-block-button__link wp-element-button">' . esc_html__( 'Read More', 'prime-blog' ) . '</a></div><!-- /wp:button --></div><!-- /wp:buttons --></div><!-- /wp:group -->',
    ] );

    register_block_pattern( 'prime-blog/two-column-text', [
        'title'      => __( 'Two-Column Text', 'prime-blog' ),
        'categories' => [ 'prime-blog', 'columns' ],
        'content'    => '<!-- wp:columns --><div class="wp-block-columns"><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>' . esc_html__( 'Column One', 'prime-blog' ) . '</h3><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Add your content here.', 'prime-blog' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:heading {"level":3} --><h3>' . esc_html__( 'Column Two', 'prime-blog' ) . '</h3><!-- /wp:heading --><!-- wp:paragraph --><p>' . esc_html__( 'Add your content here.', 'prime-blog' ) . '</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->',
    ] );
}
add_action( 'init', 'prime_blog_register_block_patterns' );

/* -----------------------------------------------------------------------
 * Content width
 * --------------------------------------------------------------------- */
function prime_blog_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'prime_blog_content_width', 780 );
}
add_action( 'after_setup_theme', 'prime_blog_content_width', 0 );

/* -----------------------------------------------------------------------
 * Font registry – all available Google Font options
 * --------------------------------------------------------------------- */
function prime_blog_get_font_options(): array {
    return [
        'DM Sans' => [
            'label' => 'DM Sans',
            'query' => 'DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400',
            'stack' => "'DM Sans', system-ui, sans-serif",
        ],
        'Inter' => [
            'label' => 'Inter',
            'query' => 'Inter:wght@300;400;500;600;700',
            'stack' => "'Inter', system-ui, sans-serif",
        ],
        'Figtree' => [
            'label' => 'Figtree',
            'query' => 'Figtree:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400',
            'stack' => "'Figtree', system-ui, sans-serif",
        ],
        'Space Grotesk' => [
            'label' => 'Space Grotesk',
            'query' => 'Space+Grotesk:wght@300;400;500;600;700',
            'stack' => "'Space Grotesk', system-ui, sans-serif",
        ],
        'Playfair Display' => [
            'label' => 'Playfair Display',
            'query' => 'Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,700',
            'stack' => "'Playfair Display', Georgia, serif",
        ],
        'Lora' => [
            'label' => 'Lora',
            'query' => 'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700',
            'stack' => "'Lora', Georgia, serif",
        ],
        'Lexend' => [
            'label' => 'Lexend',
            'query' => 'Lexend:wght@300;400;500;600;700',
            'stack' => "'Lexend', system-ui, sans-serif",
        ],
    ];
}

/* -----------------------------------------------------------------------
 * Default category colour palette
 * Colours cycle when there are more categories than palette entries.
 * --------------------------------------------------------------------- */
/**
 * Fetch all categories with a static in-memory cache.
 * Prevents identical DB queries across customize_register, customizer_css,
 * and customize_preview_js within the same request.
 */
function prime_blog_get_all_categories(): array {
    static $cache = null;
    if ( null === $cache ) {
        $cache = get_categories( [ 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC' ] );
    }
    return $cache;
}

function prime_blog_default_cat_colors(): array {
    return [
        '#0284c7', // sky
        '#16a34a', // green
        '#d97706', // amber
        '#7c3aed', // purple
        '#059669', // emerald
        '#db2777', // pink
        '#dc2626', // red
        '#0891b2', // cyan
        '#65a30d', // lime
        '#9333ea', // violet
    ];
}

/* -----------------------------------------------------------------------
 * Color helpers
 * --------------------------------------------------------------------- */

/**
 * Validate & sanitize a hex colour.  Returns $fallback if invalid.
 */
function prime_blog_sanitize_hex( string $color, string $fallback = '#000000' ): string {
    $color = sanitize_hex_color( $color );
    return $color ?: $fallback;
}

/**
 * Darken a hex color by reducing each RGB channel by $amount (0-255).
 */
function prime_blog_darken_hex( string $hex, int $amount = 30 ): string {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = max( 0, hexdec( substr( $hex, 0, 2 ) ) - $amount );
    $g = max( 0, hexdec( substr( $hex, 2, 2 ) ) - $amount );
    $b = max( 0, hexdec( substr( $hex, 4, 2 ) ) - $amount );
    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

/* -----------------------------------------------------------------------
 * Enqueue assets
 * --------------------------------------------------------------------- */
function prime_blog_scripts() {
    // Google Fonts – load whichever font is selected in the Customizer
    $fonts       = prime_blog_get_font_options();
    $chosen_font = get_theme_mod( 'prime_font_family', 'DM Sans' );
    $font_data   = $fonts[ $chosen_font ] ?? $fonts['DM Sans'];
    $font_url    = 'https://fonts.googleapis.com/css2?family=' . $font_data['query'] . '&display=swap';

    wp_enqueue_style( 'prime-blog-fonts', $font_url, [], null );

    // Main stylesheet
    wp_enqueue_style(
        'prime-blog-style',
        PRIME_BLOG_URI . '/assets/css/main.css',
        [ 'prime-blog-fonts' ],
        PRIME_BLOG_VERSION
    );

    // Main JS (defer)
    wp_enqueue_script(
        'prime-blog-main',
        PRIME_BLOG_URI . '/assets/js/main.js',
        [],
        PRIME_BLOG_VERSION,
        [ 'strategy' => 'defer', 'in_footer' => true ]
    );

    // Comment reply
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'prime_blog_scripts' );

/**
 * Output the dark-mode init script as the very first item in <head>
 * (priority 0) so the correct colour scheme is applied before the browser
 * renders anything, preventing a flash of unstyled content.
 * Hooked via wp_head so child themes and plugins can unhook it.
 */
function prime_blog_dark_mode_script(): void {
    ?>
    <script>
    (function(){
        var t = localStorage.getItem('prime-blog-theme');
        if (t) {
            document.documentElement.setAttribute('data-theme', t);
        } else if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    })();
    </script>
    <?php
}
add_action( 'wp_head', 'prime_blog_dark_mode_script', 0 );

/**
 * Load Google Fonts asynchronously so it never blocks rendering.
 * Uses the preload-then-apply trick: rel="preload" fires immediately,
 * onload swaps it to rel="stylesheet" once the font file has loaded.
 */
function prime_blog_nonblocking_fonts( string $html, string $handle ): string {
    if ( 'prime-blog-fonts' !== $handle ) {
        return $html;
    }
    $preload = str_replace( "rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html );
    return $preload . '<noscript>' . $html . '</noscript>';
}
add_filter( 'style_loader_tag', 'prime_blog_nonblocking_fonts', 10, 2 );

/* -----------------------------------------------------------------------
 * Widget areas
 * --------------------------------------------------------------------- */
function prime_blog_widgets_init() {
    register_sidebar( [
        'name'          => __( 'Blog Sidebar', 'prime-blog' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Add widgets here to appear in the sidebar.', 'prime-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer Column 1', 'prime-blog' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer Column 2', 'prime-blog' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ] );

    register_sidebar( [
        'name'          => __( 'Footer Column 3', 'prime-blog' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ] );
}
add_action( 'widgets_init', 'prime_blog_widgets_init' );

/* -----------------------------------------------------------------------
 * Excerpt
 * --------------------------------------------------------------------- */
function prime_blog_excerpt_length() { return 22; }
add_filter( 'excerpt_length', 'prime_blog_excerpt_length' );

function prime_blog_excerpt_more( $more ) { return '…'; }
add_filter( 'excerpt_more', 'prime_blog_excerpt_more' );

/* -----------------------------------------------------------------------
 * Template tags / helpers
 * --------------------------------------------------------------------- */

/**
 * Social share network definitions.
 * Each entry: label, default (on/off), share URL template, optional target, SVG icon.
 */
function prime_blog_share_networks(): array {
    return [
        'twitter' => [
            'label'   => 'Twitter / X',
            'default' => '1',
            'url'     => 'https://twitter.com/intent/tweet?url={url}&text={title}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        ],
        'facebook' => [
            'label'   => 'Facebook',
            'default' => '',
            'url'     => 'https://www.facebook.com/sharer/sharer.php?u={url}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        ],
        'linkedin' => [
            'label'   => 'LinkedIn',
            'default' => '1',
            'url'     => 'https://www.linkedin.com/shareArticle?mini=true&url={url}&title={title}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        ],
        'whatsapp' => [
            'label'   => 'WhatsApp',
            'default' => '',
            'url'     => 'https://api.whatsapp.com/send?text={title}%20{url}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>',
        ],
        'telegram' => [
            'label'   => 'Telegram',
            'default' => '',
            'url'     => 'https://t.me/share/url?url={url}&text={title}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
        ],
        'reddit' => [
            'label'   => 'Reddit',
            'default' => '',
            'url'     => 'https://www.reddit.com/submit?url={url}&title={title}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0zm5.01 4.744c.688 0 1.25.561 1.25 1.249a1.25 1.25 0 0 1-2.498.056l-2.597-.547-.8 3.747c1.824.07 3.48.632 4.674 1.488.308-.309.73-.491 1.207-.491.968 0 1.754.786 1.754 1.754 0 .716-.435 1.333-1.01 1.614a3.111 3.111 0 0 1 .042.52c0 2.694-3.13 4.87-7.004 4.87-3.874 0-7.004-2.176-7.004-4.87 0-.183.015-.366.043-.534A1.748 1.748 0 0 1 4.028 12c0-.968.786-1.754 1.754-1.754.463 0 .898.196 1.207.49 1.207-.883 2.878-1.43 4.744-1.487l.885-4.182a.342.342 0 0 1 .14-.197.35.35 0 0 1 .238-.042l2.906.617a1.214 1.214 0 0 1 1.108-.701zM9.25 12C8.561 12 8 12.562 8 13.25c0 .687.561 1.248 1.25 1.248.687 0 1.248-.561 1.248-1.249 0-.688-.561-1.249-1.249-1.249zm5.5 0c-.687 0-1.248.561-1.248 1.25 0 .687.561 1.248 1.249 1.248.688 0 1.249-.561 1.249-1.249 0-.687-.562-1.249-1.25-1.249zm-5.466 3.99a.327.327 0 0 0-.231.094.33.33 0 0 0 0 .463c.842.842 2.484.913 2.961.913.477 0 2.105-.056 2.961-.913a.361.361 0 0 0 .029-.463.33.33 0 0 0-.464 0c-.547.533-1.684.73-2.512.73-.828 0-1.979-.196-2.512-.73a.326.326 0 0 0-.232-.095z"/></svg>',
        ],
        'pinterest' => [
            'label'   => 'Pinterest',
            'default' => '',
            'url'     => 'https://pinterest.com/pin/create/button/?url={url}&description={title}',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 0 1 .083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12.017 24c6.624 0 11.988-5.367 11.988-11.987C24.005 5.367 18.641.001 12.017.001z"/></svg>',
        ],
        'email' => [
            'label'   => 'Email',
            'default' => '',
            'url'     => 'mailto:?subject={title}&body={url}',
            'target'  => '_self',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
        ],
        'copy' => [
            'label'   => __( 'Copy Link', 'prime-blog' ),
            'default' => '',
            'url'     => '',
            'icon'    => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>',
        ],
    ];
}

/**
 * Render the share bar on single posts.
 * All network buttons are always present in the DOM; disabled ones are hidden
 * via CSS (prime_blog_customizer_css) so the Customizer live-preview can
 * toggle them instantly without a page reload.
 */
function prime_blog_share_bar(): void {
    $networks   = prime_blog_share_networks();
    $post_url   = rawurlencode( get_permalink() );
    $post_title = rawurlencode( get_the_title() );
    ?>
    <div class="share-bar" aria-label="<?php esc_attr_e( 'Share this post', 'prime-blog' ); ?>">
        <span><?php esc_html_e( 'Share', 'prime-blog' ); ?></span>
        <?php foreach ( $networks as $id => $net ) : ?>
            <?php if ( $id === 'copy' ) : ?>
                <button
                    class="share-btn share-btn--copy"
                    data-share="copy"
                    data-url="<?php echo esc_attr( get_permalink() ); ?>"
                    title="<?php esc_attr_e( 'Copy link', 'prime-blog' ); ?>"
                    aria-label="<?php esc_attr_e( 'Copy link to clipboard', 'prime-blog' ); ?>"
                ><?php echo $net['icon']; ?></button>
            <?php else :
                $href   = str_replace( [ '{url}', '{title}' ], [ $post_url, $post_title ], $net['url'] );
                $target = $net['target'] ?? '_blank';
                /* translators: %s: social network name */
                $aria   = sprintf( esc_attr__( 'Share on %s', 'prime-blog' ), $net['label'] );
            ?>
                <a
                    class="share-btn share-btn--<?php echo esc_attr( $id ); ?>"
                    data-share="<?php echo esc_attr( $id ); ?>"
                    href="<?php echo esc_url_raw( $href ); ?>"
                    target="<?php echo esc_attr( $target ); ?>"
                    rel="noopener noreferrer"
                    title="<?php echo $aria; ?>"
                    aria-label="<?php echo $aria; ?>"
                ><?php echo $net['icon']; ?></a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php
}

/**
 * Print the first category with a link, styled as a pill tag.
 */
function prime_blog_post_tag() {
    $cats = get_the_category();
    if ( ! $cats ) return;
    foreach ( $cats as $cat ) {
        printf(
            '<a class="post-tag" data-cat="%s" href="%s">%s</a>',
            esc_attr( $cat->slug ),
            esc_url( get_category_link( $cat->term_id ) ),
            esc_html( $cat->name )
        );
    }
}

/**
 * Print author avatar + name linked to author archive.
 */
function prime_blog_author_meta() {
    $author_id = get_the_author_meta( 'ID' );
    printf(
        '<a class="post-author" href="%s">%s<span>%s</span></a>',
        esc_url( get_author_posts_url( $author_id ) ),
        get_avatar( $author_id, 36, '', '', [ 'class' => 'author-avatar' ] ),
        esc_html( get_the_author() )
    );
}

/**
 * Print reading-time estimate.
 */
function prime_blog_reading_time() {
    $words   = str_word_count( wp_strip_all_tags( get_the_content() ) );
    $minutes = max( 1, (int) round( $words / 200 ) );
    printf(
        '<span class="reading-time">%s %s</span>',
        esc_html( $minutes ),
        esc_html( _n( 'min read', 'min read', $minutes, 'prime-blog' ) )
    );
}

/**
 * Body classes – add dark-mode-capable class.
 */
function prime_blog_body_classes( $classes ) {
    $classes[] = 'prime-blog';
    if ( is_singular() ) {
        $classes[] = 'is-singular';
    }
    return $classes;
}
add_filter( 'body_class', 'prime_blog_body_classes' );

/**
 * Add defer to Google Fonts link element.
 */
function prime_blog_add_resource_hints( $hints, $relation_type ) {
    if ( 'preconnect' === $relation_type ) {
        $hints[] = [ 'href' => 'https://fonts.googleapis.com' ];
        $hints[] = [ 'href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous' ];
    }
    return $hints;
}
add_filter( 'wp_resource_hints', 'prime_blog_add_resource_hints', 10, 2 );

/* =============================================================================
 * THEME CUSTOMIZER
 * ============================================================================= */

/* -----------------------------------------------------------------------
 * 1. Register settings, sections, and controls
 * --------------------------------------------------------------------- */
function prime_blog_customize_register( WP_Customize_Manager $wp_customize ): void {

    // ── Top-level panel ──────────────────────────────────────────────────────
    $wp_customize->add_panel( 'prime_blog_panel', [
        'title'       => __( 'Prime Blog', 'prime-blog' ),
        'description' => __( 'Customise colours, typography, and layout for the Prime Blog theme.', 'prime-blog' ),
        'priority'    => 30,
    ] );

    // =========================================================================
    // SECTION 1 – Light Mode Colors
    // =========================================================================
    $wp_customize->add_section( 'prime_colors_light', [
        'title'    => __( 'Colors – Light Mode', 'prime-blog' ),
        'panel'    => 'prime_blog_panel',
        'priority' => 10,
    ] );

    $light_colors = [
        'prime_accent'      => [ '#FD3D00', __( 'Accent Color',            'prime-blog' ), 'postMessage' ],
        'prime_link'        => [ '#6ba9de', __( 'Link Color',              'prime-blog' ), 'postMessage' ],
        'prime_bg'          => [ '#ffffff', __( 'Background',              'prime-blog' ), 'postMessage' ],
        'prime_bg_soft'     => [ '#f7f7f7', __( 'Secondary Background',    'prime-blog' ), 'postMessage' ],
        'prime_card_bg'     => [ '#ffffff', __( 'Card Background',         'prime-blog' ), 'postMessage' ],
        'prime_text'        => [ '#111111', __( 'Heading / Primary Text',  'prime-blog' ), 'postMessage' ],
        'prime_text_muted'  => [ '#6b7280', __( 'Body Text',               'prime-blog' ), 'postMessage' ],
        'prime_text_subtle' => [ '#9ca3af', __( 'Subtle / Meta Text',      'prime-blog' ), 'postMessage' ],
        'prime_border'      => [ '#e5e7eb', __( 'Border Color',            'prime-blog' ), 'postMessage' ],
    ];

    foreach ( $light_colors as $id => [ $default, $label, $transport ] ) {
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => $transport,
        ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
            'label'   => $label,
            'section' => 'prime_colors_light',
        ] ) );
    }

    // =========================================================================
    // SECTION 2 – Category Colors
    // =========================================================================
    $wp_customize->add_section( 'prime_category_colors', [
        'title'       => __( 'Category Colors', 'prime-blog' ),
        'description' => __( 'Each category badge, archive heading, and card accent uses its own color. New categories you create in WordPress will appear here automatically.', 'prime-blog' ),
        'panel'       => 'prime_blog_panel',
        'priority'    => 15,
    ] );

    $palette    = prime_blog_default_cat_colors();
    $categories = prime_blog_get_all_categories();

    foreach ( $categories as $i => $cat ) {
        $setting_id = 'prime_cat_color_' . $cat->slug;
        $default    = $palette[ $i % count( $palette ) ];

        $wp_customize->add_setting( $setting_id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, [
            'label'   => $cat->name,
            'section' => 'prime_category_colors',
        ] ) );
    }

    // =========================================================================
    // SECTION 3 – Dark Mode Colors (was Section 2)
    // =========================================================================
    $wp_customize->add_section( 'prime_colors_dark', [
        'title'       => __( 'Colors – Dark Mode', 'prime-blog' ),
        'description' => __( 'These values apply when the visitor switches to dark mode.', 'prime-blog' ),
        'panel'       => 'prime_blog_panel',
        'priority'    => 20,
    ] );

    $dark_colors = [
        'prime_dark_bg'          => [ '#0c0c0e', __( 'Dark Background',           'prime-blog' ), 'postMessage' ],
        'prime_dark_bg_soft'     => [ '#141417', __( 'Dark Secondary Background', 'prime-blog' ), 'postMessage' ],
        'prime_dark_card_bg'     => [ '#18181b', __( 'Dark Card Background',      'prime-blog' ), 'postMessage' ],
        'prime_dark_text'        => [ '#f4f4f5', __( 'Dark Primary Text',         'prime-blog' ), 'postMessage' ],
        'prime_dark_text_muted'  => [ '#a1a1aa', __( 'Dark Body Text',            'prime-blog' ), 'postMessage' ],
        'prime_dark_text_subtle' => [ '#71717a', __( 'Dark Subtle / Meta Text',   'prime-blog' ), 'postMessage' ],
        'prime_dark_border'      => [ '#27272a', __( 'Dark Border Color',         'prime-blog' ), 'postMessage' ],
    ];

    foreach ( $dark_colors as $id => [ $default, $label, $transport ] ) {
        $wp_customize->add_setting( $id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => $transport,
        ] );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, [
            'label'   => $label,
            'section' => 'prime_colors_dark',
        ] ) );
    }

    // =========================================================================
    // SECTION 3 – Typography
    // =========================================================================
    $wp_customize->add_section( 'prime_typography', [
        'title'    => __( 'Typography', 'prime-blog' ),
        'panel'    => 'prime_blog_panel',
        'priority' => 30,
    ] );

    // Font family select
    $font_choices = array_map( fn( $f ) => $f['label'], prime_blog_get_font_options() );

    $wp_customize->add_setting( 'prime_font_family', [
        'default'           => 'DM Sans',
        'sanitize_callback' => fn( $v ) => array_key_exists( $v, prime_blog_get_font_options() ) ? $v : 'DM Sans',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_font_family', [
        'label'   => __( 'Font Family', 'prime-blog' ),
        'section' => 'prime_typography',
        'type'    => 'select',
        'choices' => $font_choices,
    ] );

    // Base font size
    $wp_customize->add_setting( 'prime_base_font_size', [
        'default'           => 16,
        'sanitize_callback' => fn( $v ) => max( 14, min( 20, (int) $v ) ),
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_base_font_size', [
        'label'       => __( 'Base Font Size (px)', 'prime-blog' ),
        'description' => __( 'Affects body text size (14–20px).', 'prime-blog' ),
        'section'     => 'prime_typography',
        'type'        => 'range',
        'input_attrs' => [ 'min' => 14, 'max' => 20, 'step' => 1 ],
    ] );

    // =========================================================================
    // SECTION 4 – Share Buttons
    // =========================================================================
    $wp_customize->add_section( 'prime_share_buttons', [
        'title'       => __( 'Share Buttons', 'prime-blog' ),
        'description' => __( 'Choose which networks appear on single posts. Changes are previewed instantly.', 'prime-blog' ),
        'panel'       => 'prime_blog_panel',
        'priority'    => 35,
    ] );

    // Master on/off toggle
    $wp_customize->add_setting( 'prime_share_enabled', [
        'default'           => '1',
        'sanitize_callback' => fn( $v ) => $v ? '1' : '',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_share_enabled', [
        'label'   => __( 'Show Share Bar', 'prime-blog' ),
        'section' => 'prime_share_buttons',
        'type'    => 'checkbox',
    ] );

    // Per-network toggles
    foreach ( prime_blog_share_networks() as $id => $net ) {
        $wp_customize->add_setting( 'prime_share_' . $id, [
            'default'           => $net['default'],
            'sanitize_callback' => fn( $v ) => $v ? '1' : '',
            'transport'         => 'postMessage',
        ] );
        $wp_customize->add_control( 'prime_share_' . $id, [
            'label'   => $net['label'],
            'section' => 'prime_share_buttons',
            'type'    => 'checkbox',
        ] );
    }

    // =========================================================================
    // SECTION 5 – Layout
    // =========================================================================
    $wp_customize->add_section( 'prime_layout', [
        'title'    => __( 'Layout', 'prime-blog' ),
        'panel'    => 'prime_blog_panel',
        'priority' => 40,
    ] );

    // Posts per row – Desktop (> 1024 px)
    $wp_customize->add_setting( 'prime_grid_cols', [
        'default'           => '3',
        'sanitize_callback' => fn( $v ) => in_array( $v, [ '2', '3' ], true ) ? $v : '3',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_grid_cols', [
        'label'       => __( 'Posts per row – Desktop', 'prime-blog' ),
        'description' => __( 'Applies on screens wider than 1024 px.', 'prime-blog' ),
        'section'     => 'prime_layout',
        'type'        => 'select',
        'choices'     => [ '2' => __( '2 columns', 'prime-blog' ), '3' => __( '3 columns', 'prime-blog' ) ],
    ] );

    // Posts per row – Tablet (601 – 1024 px)
    $wp_customize->add_setting( 'prime_grid_cols_tablet', [
        'default'           => '2',
        'sanitize_callback' => fn( $v ) => in_array( $v, [ '1', '2' ], true ) ? $v : '2',
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_grid_cols_tablet', [
        'label'       => __( 'Posts per row – Tablet', 'prime-blog' ),
        'description' => __( 'Applies on screens 601–1024 px (iPad, landscape phone). Mobile always uses 1 column.', 'prime-blog' ),
        'section'     => 'prime_layout',
        'type'        => 'select',
        'choices'     => [ '1' => __( '1 column', 'prime-blog' ), '2' => __( '2 columns', 'prime-blog' ) ],
    ] );

    // Card border radius
    $wp_customize->add_setting( 'prime_card_radius', [
        'default'           => 10,
        'sanitize_callback' => fn( $v ) => max( 0, min( 28, (int) $v ) ),
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_card_radius', [
        'label'       => __( 'Card Border Radius (px)', 'prime-blog' ),
        'description' => __( 'Roundness of post cards (0–28px).', 'prime-blog' ),
        'section'     => 'prime_layout',
        'type'        => 'range',
        'input_attrs' => [ 'min' => 0, 'max' => 28, 'step' => 1 ],
    ] );

    // Max container width
    $wp_customize->add_setting( 'prime_container_width', [
        'default'           => 1200,
        'sanitize_callback' => fn( $v ) => max( 960, min( 1600, (int) $v ) ),
        'transport'         => 'postMessage',
    ] );
    $wp_customize->add_control( 'prime_container_width', [
        'label'       => __( 'Container Width (px)', 'prime-blog' ),
        'description' => __( 'Maximum width of content areas (960–1600px).', 'prime-blog' ),
        'section'     => 'prime_layout',
        'type'        => 'range',
        'input_attrs' => [ 'min' => 960, 'max' => 1600, 'step' => 20 ],
    ] );
}
add_action( 'customize_register', 'prime_blog_customize_register' );

/* -----------------------------------------------------------------------
 * 2. Output dynamic CSS custom properties in <head>
 *    These override the defaults in main.css without touching the file.
 * --------------------------------------------------------------------- */
function prime_blog_customizer_css(): void {
    // Cache the generated CSS in a transient so it isn't recomputed on every
    // page load. Skip the cache inside the Customizer preview iframe so changes
    // are reflected immediately without needing to save first.
    $cache_key = 'prime_blog_css_' . PRIME_BLOG_VERSION;
    $use_cache = ! is_customize_preview();

    if ( $use_cache ) {
        $cached = get_transient( $cache_key );
        if ( false !== $cached ) {
            echo $cached; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
        ob_start();
    }

    $fonts = prime_blog_get_font_options();

    // ── Retrieve all mod values (falls back to default when untouched) ──────
    $accent        = prime_blog_sanitize_hex( get_theme_mod( 'prime_accent',      '#FD3D00' ) );
    $accent_dark   = prime_blog_darken_hex( $accent, 30 );
    $accent_light  = '#' . implode( '', array_map(
        fn( $c ) => sprintf( '%02x', min( 255, $c + 40 ) ),
        [ hexdec( substr( ltrim( $accent, '#' ), 0, 2 ) ),
          hexdec( substr( ltrim( $accent, '#' ), 2, 2 ) ),
          hexdec( substr( ltrim( $accent, '#' ), 4, 2 ) ) ]
    ) );

    $bg          = prime_blog_sanitize_hex( get_theme_mod( 'prime_bg',          '#ffffff' ) );
    $bg_soft     = prime_blog_sanitize_hex( get_theme_mod( 'prime_bg_soft',     '#f7f7f7' ) );
    $card_bg     = prime_blog_sanitize_hex( get_theme_mod( 'prime_card_bg',     '#ffffff' ) );
    $text        = prime_blog_sanitize_hex( get_theme_mod( 'prime_text',        '#111111' ) );
    $text_muted  = prime_blog_sanitize_hex( get_theme_mod( 'prime_text_muted',  '#6b7280' ) );
    $text_subtle = prime_blog_sanitize_hex( get_theme_mod( 'prime_text_subtle', '#9ca3af' ) );
    $border      = prime_blog_sanitize_hex( get_theme_mod( 'prime_border',      '#e5e7eb' ) );
    $link        = prime_blog_sanitize_hex( get_theme_mod( 'prime_link',        '#6ba9de' ) );
    $link_hover  = prime_blog_darken_hex( $link, 28 );

    $dark_bg          = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_bg',          '#0c0c0e' ) );
    $dark_bg_soft     = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_bg_soft',     '#141417' ) );
    $dark_card_bg     = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_card_bg',     '#18181b' ) );
    $dark_text        = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_text',        '#f4f4f5' ) );
    $dark_text_muted  = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_text_muted',  '#a1a1aa' ) );
    $dark_text_subtle = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_text_subtle', '#71717a' ) );
    $dark_border      = prime_blog_sanitize_hex( get_theme_mod( 'prime_dark_border',      '#27272a' ) );

    $chosen_font       = get_theme_mod( 'prime_font_family', 'DM Sans' );
    $font_data         = $fonts[ $chosen_font ] ?? $fonts['DM Sans'];
    // Strip only </style> sequences — single quotes are valid in CSS font stacks
    $font_stack        = str_ireplace( '</style', '', $font_data['stack'] );

    $base_font_size    = max( 14, min( 20, (int) get_theme_mod( 'prime_base_font_size', 16 ) ) );
    $card_radius       = max(  0, min( 28, (int) get_theme_mod( 'prime_card_radius',    10 ) ) );
    $container_width   = max( 960, min( 1600, (int) get_theme_mod( 'prime_container_width', 1200 ) ) );
    $grid_cols         = get_theme_mod( 'prime_grid_cols', '3' ) === '2' ? 2 : 3;
    $grid_cols_tablet  = get_theme_mod( 'prime_grid_cols_tablet', '2' ) === '1' ? 1 : 2;

    // ── Category colors – dynamic: reads every category in the site ─────────
    $palette    = prime_blog_default_cat_colors();
    $categories = prime_blog_get_all_categories();
    $cat_colors = [];
    foreach ( $categories as $i => $cat ) {
        $default               = $palette[ $i % count( $palette ) ];
        $mod                   = get_theme_mod( 'prime_cat_color_' . $cat->slug, $default );
        $cat_colors[ $cat->slug ] = prime_blog_sanitize_hex( $mod, $default );
    }

    ?>
    <style id="prime-blog-customizer-css">
    :root {
        --accent:        <?php echo $accent; ?>;
        --accent-dark:   <?php echo $accent_dark; ?>;
        --accent-light:  <?php echo $accent_light; ?>;
        --bg:            <?php echo $bg; ?>;
        --bg-soft:       <?php echo $bg_soft; ?>;
        --card-bg:       <?php echo $card_bg; ?>;
        --text:          <?php echo $text; ?>;
        --text-muted:    <?php echo $text_muted; ?>;
        --text-subtle:   <?php echo $text_subtle; ?>;
        --border:        <?php echo $border; ?>;
        --link:          <?php echo $link; ?>;
        --link-hover:    <?php echo $link_hover; ?>;
        --font:          <?php echo $font_stack; ?>;
        --container:     <?php echo $container_width; ?>px;
        --radius-lg:     <?php echo $card_radius; ?>px;

        /* ── Category colors ── */
        <?php foreach ( $cat_colors as $slug => $color ) : ?>
        --cat-<?php echo $slug; ?>: <?php echo $color; ?>;
        <?php endforeach; ?>
    }
    [data-theme="dark"] {
        --bg:            <?php echo $dark_bg; ?>;
        --bg-soft:       <?php echo $dark_bg_soft; ?>;
        --card-bg:       <?php echo $dark_card_bg; ?>;
        --text:          <?php echo $dark_text; ?>;
        --text-muted:    <?php echo $dark_text_muted; ?>;
        --text-subtle:   <?php echo $dark_text_subtle; ?>;
        --border:        <?php echo $dark_border; ?>;
    }
    body { font-size: <?php echo $base_font_size; ?>px; }
    /* Grid columns – desktop only; mobile breakpoints in main.css are untouched */
    @media (min-width: 1025px) {
        .posts-grid { grid-template-columns: repeat(<?php echo $grid_cols; ?>, 1fr); }
    }
    /* Grid columns – tablet (601–1024 px) */
    @media (max-width: 1024px) and (min-width: 601px) {
        .posts-grid { grid-template-columns: repeat(<?php echo $grid_cols_tablet; ?>, 1fr); }
    }
    /* Mobile (≤ 600 px): always 1 column – handled by main.css */

    /* ── Share bar visibility ── */
    <?php if ( ! get_theme_mod( 'prime_share_enabled', '1' ) ) : ?>
    .share-bar { display: none; }
    <?php endif; ?>
    <?php foreach ( prime_blog_share_networks() as $sid => $snet ) : ?>
    <?php if ( ! get_theme_mod( 'prime_share_' . $sid, $snet['default'] ) ) : ?>
    .share-btn[data-share="<?php echo esc_attr( $sid ); ?>"] { display: none; }
    <?php endif; ?>
    <?php endforeach; ?>

    /* ── Per-category badge + archive accents (all categories, dynamic) ── */
    <?php foreach ( $cat_colors as $slug => $color ) :
        $safe_slug = sanitize_html_class( $slug );
    ?>
    .post-tag[data-cat="<?php echo $safe_slug; ?>"] { --cat: var(--cat-<?php echo $safe_slug; ?>); }
    body.category-<?php echo $safe_slug; ?> .hero-tag,
    body.category-<?php echo $safe_slug; ?> .section-label { color: <?php echo $color; ?>; }
    body.category-<?php echo $safe_slug; ?> .page-hero     { border-bottom-color: <?php echo $color; ?>40; }
    body.tag-<?php echo $safe_slug; ?> .hero-tag            { color: <?php echo $color; ?>; }
    <?php endforeach; ?>
    </style>
    <?php
    if ( $use_cache ) {
        $generated = ob_get_clean();
        set_transient( $cache_key, $generated, WEEK_IN_SECONDS );
        echo $generated; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}
add_action( 'wp_head', 'prime_blog_customizer_css', 99 );

// Bust the CSS transient whenever the user saves Customizer settings.
add_action( 'customize_save_after', function () {
    delete_transient( 'prime_blog_css_' . PRIME_BLOG_VERSION );
} );

/* -----------------------------------------------------------------------
 * 3. Enqueue Customizer live-preview script (only inside the Customizer)
 * --------------------------------------------------------------------- */
function prime_blog_customize_preview_js(): void {
    wp_enqueue_script(
        'prime-blog-customizer',
        PRIME_BLOG_URI . '/assets/js/customizer.js',
        [ 'customize-preview' ],
        PRIME_BLOG_VERSION,
        true
    );

    // Pass font data and all category slugs to JS
    $palette    = prime_blog_default_cat_colors();
    $categories = prime_blog_get_all_categories();
    $cat_js     = [];
    foreach ( $categories as $i => $cat ) {
        $cat_js[] = [
            'slug'    => $cat->slug,
            'setting' => 'prime_cat_color_' . $cat->slug,
            'cssVar'  => '--cat-' . $cat->slug,
            'default' => $palette[ $i % count( $palette ) ],
        ];
    }

    $share_js = [];
    foreach ( prime_blog_share_networks() as $sid => $snet ) {
        $share_js[] = [ 'id' => $sid, 'setting' => 'prime_share_' . $sid ];
    }

    wp_localize_script( 'prime-blog-customizer', 'primeBlogCustomizer', [
        'fonts'         => prime_blog_get_font_options(),
        'fontsApiBase'  => 'https://fonts.googleapis.com/css2?family=',
        'categories'    => $cat_js,
        'shareNetworks' => $share_js,
    ] );
}
add_action( 'customize_preview_init', 'prime_blog_customize_preview_js' );

/* -----------------------------------------------------------------------
 * 4. Enqueue Customizer controls script (adds range live-value display)
 * --------------------------------------------------------------------- */
function prime_blog_customize_controls_js(): void {
    wp_enqueue_script(
        'prime-blog-customizer-controls',
        PRIME_BLOG_URI . '/assets/js/customizer-controls.js',
        [ 'customize-controls' ],
        PRIME_BLOG_VERSION,
        true
    );
}
add_action( 'customize_controls_enqueue_scripts', 'prime_blog_customize_controls_js' );

/**
 * Custom walker for navigation – adds aria attrs to nav links.
 */
class Prime_Blog_Walker_Nav extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="sub-menu" role="menu">';
    }
    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes     = empty( $item->classes ) ? [] : (array) $item->classes;
        $has_children = in_array( 'menu-item-has-children', $classes );
        $class_str   = implode( ' ', array_filter( $classes ) );

        $output .= '<li class="' . esc_attr( $class_str ) . '">';

        $atts = [];
        $atts['href']  = ! empty( $item->url )    ? $item->url    : '#';
        $atts['title'] = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target']= ! empty( $item->target )  ? $item->target : '';
        $atts['rel']   = ! empty( $item->xfn )     ? $item->xfn    : '';
        if ( $has_children ) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        $attrs = '';
        foreach ( $atts as $attr => $value ) {
            if ( '' !== $value ) {
                $attrs .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
            }
        }

        $title  = apply_filters( 'the_title', $item->title, $item->ID );
        $arrow  = $has_children ? '<span class="nav-arrow" aria-hidden="true"></span>' : '';
        $output .= '<a' . $attrs . '>' . esc_html( $title ) . $arrow . '</a>';
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
