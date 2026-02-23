<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( is_singular( 'post' ) ) : ?>
<div class="reading-progress" role="progressbar" aria-label="<?php esc_attr_e( 'Reading progress', 'prime-blog' ); ?>"></div>
<?php endif; ?>

<a class="sr-only" href="#main-content"><?php esc_html_e( 'Skip to content', 'prime-blog' ); ?></a>

<!-- ===== SITE HEADER ===== -->
<header class="site-header" role="banner">
  <div class="container">
    <div class="header-inner">

      <!-- Logo -->
      <a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
        <?php if ( has_custom_logo() ) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <span class="logo-text">
            <?php
              $name  = get_bloginfo( 'name' );
              $parts = preg_split('/\s+/', trim( $name ), 2);
              if ( count( $parts ) === 2 ) {
                echo esc_html( $parts[0] ) . '<span>' . esc_html( $parts[1] ) . '</span>';
              } else {
                echo '<span>' . esc_html( $name ) . '</span>';
              }
            ?>
          </span>
        <?php endif; ?>
      </a>

      <!-- Desktop navigation -->
      <nav class="main-nav" id="site-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'prime-blog' ); ?>">
        <?php
          wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => '',
            'fallback_cb'    => function() {
              echo '<ul>';
              echo '<li><a href="' . esc_url( home_url('/') ) . '">' . esc_html__('Home', 'prime-blog') . '</a></li>';
              echo '<li><a href="' . esc_url( home_url('/blog') ) . '">' . esc_html__('Blog', 'prime-blog') . '</a></li>';
              echo '</ul>';
            },
            'walker'         => new Prime_Blog_Walker_Nav(),
          ] );
        ?>
      </nav>

      <!-- Header actions -->
      <div class="header-actions">
        <!-- Search (via get_search_form() so it can be filtered/overridden) -->
        <?php get_search_form(); ?>

        <!-- Dark mode toggle -->
        <button class="btn-icon" id="theme-toggle" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'prime-blog' ); ?>" title="<?php esc_attr_e( 'Dark mode', 'prime-blog' ); ?>">
          <!-- Moon icon (shown in light mode) -->
          <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
          </svg>
          <!-- Sun icon (shown in dark mode) -->
          <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="display:none">
            <circle cx="12" cy="12" r="5"></circle>
            <line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line>
            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
            <line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line>
            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
          </svg>
        </button>

        <!-- Mobile hamburger -->
        <button class="hamburger" aria-label="<?php esc_attr_e( 'Open menu', 'prime-blog' ); ?>" aria-expanded="false" aria-controls="mobile-nav">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>

    </div><!-- .header-inner -->
  </div><!-- .container -->
</header>

<!-- ===== MOBILE NAV ===== -->
<nav class="mobile-nav" id="mobile-nav" aria-label="<?php esc_attr_e( 'Mobile navigation', 'prime-blog' ); ?>">
  <?php
    wp_nav_menu( [
      'theme_location' => 'primary',
      'container'      => false,
      'menu_class'     => '',
      'fallback_cb'    => function() {
        echo '<a href="' . esc_url( home_url('/') ) . '">' . esc_html__('Home', 'prime-blog') . '</a>';
        echo '<a href="' . esc_url( home_url('/blog') ) . '">' . esc_html__('Blog', 'prime-blog') . '</a>';
      },
    ] );
  ?>
</nav>

<main id="main-content" tabindex="-1">
