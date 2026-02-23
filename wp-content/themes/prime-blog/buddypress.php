<?php get_header(); ?>

<!-- BP-aware page hero -->
<div class="page-hero bp-page-hero">
  <div class="container">
    <?php if ( function_exists('bp_is_register_page') && bp_is_register_page() ) : ?>
      <p class="hero-tag"><?php esc_html_e('Community', 'prime-blog'); ?></p>
      <h1><?php esc_html_e('Create Account', 'prime-blog'); ?></h1>

    <?php elseif ( function_exists('bp_is_activation_page') && bp_is_activation_page() ) : ?>
      <p class="hero-tag"><?php esc_html_e('Community', 'prime-blog'); ?></p>
      <h1><?php esc_html_e('Activate Account', 'prime-blog'); ?></h1>

    <?php elseif ( function_exists('bp_is_user') && bp_is_user() ) : ?>
      <p class="hero-tag"><?php esc_html_e('Member', 'prime-blog'); ?></p>
      <h1><?php echo esc_html( bp_get_displayed_user_fullname() ); ?></h1>

    <?php elseif ( function_exists('bp_is_group') && bp_is_group() ) : ?>
      <p class="hero-tag"><?php esc_html_e('Group', 'prime-blog'); ?></p>
      <h1><?php echo esc_html( bp_get_current_group_name() ); ?></h1>

    <?php else : ?>
      <!-- Directory pages: Members, Groups, Activity -->
      <p class="hero-tag"><?php esc_html_e('Community', 'prime-blog'); ?></p>
      <h1><?php
        if ( function_exists('bp_is_activity_component') && bp_is_activity_component() )
          esc_html_e('Activity', 'prime-blog');
        elseif ( function_exists('bp_is_members_component') && bp_is_members_component() )
          esc_html_e('Members', 'prime-blog');
        elseif ( function_exists('bp_is_groups_component') && bp_is_groups_component() )
          esc_html_e('Groups', 'prime-blog');
        else
          wp_title( '' );
      ?></h1>
    <?php endif; ?>
  </div>
</div>

<!-- BP content (BP injects its #buddypress-wrapped HTML via the_content) -->
<div class="bp-wrap">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
