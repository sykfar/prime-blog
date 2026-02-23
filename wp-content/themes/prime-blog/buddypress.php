<?php get_header(); ?>

<?php
  /*
   * BuddyBoss renders its own rich cover-image-header (avatar, cover photo,
   * name, follower counts, action buttons) inside the_content() on single
   * member/group pages.  Showing a theme hero on top of that duplicates the
   * member name, so we suppress the hero for those pages.
   *
   * Hero is shown only for:
   *   • Directory pages  (Members, Groups, Activity)
   *   • Auth pages       (Register, Activate)
   * Single member/group pages → NO hero at all.
   */
  $is_single    = ( function_exists('bp_is_user')  && bp_is_user() )
               || ( function_exists('bp_is_group') && bp_is_group() );

  $is_directory = ! $is_single && (
      ( function_exists('bp_is_members_component')  && bp_is_members_component() )
   || ( function_exists('bp_is_groups_component')   && bp_is_groups_component() )
   || ( function_exists('bp_is_activity_component') && bp_is_activity_component() )
  );

  $is_auth      = ( function_exists('bp_is_register_page')   && bp_is_register_page() )
               || ( function_exists('bp_is_activation_page') && bp_is_activation_page() );
?>

<?php if ( $is_auth ) : ?>
  <!-- Auth hero (Register / Activate) -->
  <div class="page-hero bp-page-hero">
    <div class="container">
      <p class="hero-tag"><?php esc_html_e( 'Community', 'prime-blog' ); ?></p>
      <?php if ( function_exists('bp_is_register_page') && bp_is_register_page() ) : ?>
        <h1><?php esc_html_e( 'Create Account', 'prime-blog' ); ?></h1>
      <?php else : ?>
        <h1><?php esc_html_e( 'Activate Account', 'prime-blog' ); ?></h1>
      <?php endif; ?>
    </div>
  </div>

<?php elseif ( $is_directory ) : ?>
  <!-- Slim directory hero — label only, no member/group name duplication -->
  <div class="page-hero bp-page-hero bp-directory-hero">
    <div class="container">
      <p class="hero-tag"><?php esc_html_e( 'Community', 'prime-blog' ); ?></p>
      <h1><?php
        if ( function_exists('bp_is_activity_component') && bp_is_activity_component() )
          esc_html_e( 'Activity', 'prime-blog' );
        elseif ( function_exists('bp_is_members_component') && bp_is_members_component() )
          esc_html_e( 'Members', 'prime-blog' );
        elseif ( function_exists('bp_is_groups_component') && bp_is_groups_component() )
          esc_html_e( 'Groups', 'prime-blog' );
        else
          echo esc_html( get_the_title( get_queried_object_id() ) );
      ?></h1>
    </div>
  </div>

<?php elseif ( ! $is_single ) : ?>
  <!-- Fallback hero for any other BP page that isn't a single profile/group -->
  <div class="page-hero bp-page-hero">
    <div class="container">
      <p class="hero-tag"><?php esc_html_e( 'Community', 'prime-blog' ); ?></p>
      <h1><?php echo esc_html( get_the_title( get_queried_object_id() ) ); ?></h1>
    </div>
  </div>
<?php endif; ?>
<!-- $is_single → no hero; BuddyBoss cover-image-header renders its own -->

<div class="bp-wrap<?php echo $is_single ? ' bp-single-page' : ''; ?>">
  <div class="container">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; ?>
  </div>
</div>

<?php get_footer(); ?>
