<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <div class="page-hero">
    <div class="container">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>

  <div class="content-container" style="padding: 3rem 1.5rem;">
    <div class="entry-content">
      <?php
        the_content();
        wp_link_pages( [
          'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Page pages', 'prime-blog' ) . '"><span class="page-links-title">' . esc_html__( 'Pages:', 'prime-blog' ) . '</span>',
          'after'       => '</nav>',
          'link_before' => '<span class="page-number">',
          'link_after'  => '</span>',
        ] );
      ?>
    </div>

    <?php
      if ( comments_open() || get_comments_number() ) {
        comments_template();
      }
    ?>
  </div>

<?php endwhile; ?>

<?php get_footer(); ?>
