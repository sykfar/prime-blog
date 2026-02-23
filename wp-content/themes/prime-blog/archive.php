<?php get_header(); ?>

<!-- Archive / tag / category header -->
<div class="page-hero">
  <div class="container">
    <?php if ( is_category() ) : ?>
      <p class="hero-tag">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
        <?php esc_html_e('Category', 'prime-blog'); ?>
      </p>
      <h1><?php single_cat_title(); ?></h1>
      <?php if ( category_description() ) : ?>
        <p class="hero-desc"><?php echo wp_kses_post( category_description() ); ?></p>
      <?php endif; ?>

    <?php elseif ( is_tag() ) : ?>
      <p class="hero-tag">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
        <?php esc_html_e('Tag', 'prime-blog'); ?>
      </p>
      <h1><?php single_tag_title(); ?></h1>
      <?php if ( tag_description() ) : ?>
        <p class="hero-desc"><?php echo wp_kses_post( tag_description() ); ?></p>
      <?php endif; ?>

    <?php elseif ( is_author() ) : ?>
      <p class="hero-tag"><?php esc_html_e('Author', 'prime-blog'); ?></p>
      <h1><?php the_author(); ?></h1>
      <?php if ( get_the_author_meta('description') ) : ?>
        <p class="hero-desc"><?php echo esc_html( get_the_author_meta('description') ); ?></p>
      <?php endif; ?>

    <?php elseif ( is_date() ) : ?>
      <p class="hero-tag"><?php esc_html_e('Archive', 'prime-blog'); ?></p>
      <h1>
        <?php
          if ( is_year() )         echo get_the_date('Y');
          elseif ( is_month() )    echo get_the_date('F Y');
          elseif ( is_day() )      echo get_the_date('F j, Y');
        ?>
      </h1>

    <?php else : ?>
      <p class="hero-tag"><?php esc_html_e('Archive', 'prime-blog'); ?></p>
      <h1><?php the_archive_title(); ?></h1>
      <?php the_archive_description('<p class="hero-desc">', '</p>'); ?>
    <?php endif; ?>
  </div>
</div>

<!-- Posts -->
<div class="posts-section">
  <div class="container">
    <div class="content-with-sidebar">

      <div class="main-column">
        <?php if ( have_posts() ) : ?>
          <div class="posts-grid">
            <?php while ( have_posts() ) : the_post(); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                  <a class="post-card-image-wrap" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                    <?php the_post_thumbnail('prime-card', ['alt' => get_the_title()]); ?>
                  </a>
                <?php else : ?>
                  <div class="post-card-no-image">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                      <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                      <circle cx="8.5" cy="8.5" r="1.5"></circle>
                      <polyline points="21 15 16 10 5 21"></polyline>
                    </svg>
                  </div>
                <?php endif; ?>

                <div class="post-card-body">
                  <div class="post-card-top">
                    <?php prime_blog_post_tag(); ?>
                    <time class="post-date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                  </div>
                  <h2 class="post-card-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h2>
                  <p class="post-card-excerpt"><?php the_excerpt(); ?></p>
                  <div class="post-card-footer">
                    <?php prime_blog_author_meta(); ?>
                    <?php prime_blog_reading_time(); ?>
                  </div>
                </div>
              </article>

            <?php endwhile; ?>
          </div><!-- .posts-grid -->

          <div class="pagination">
            <?php echo paginate_links(['mid_size' => 2, 'prev_text' => '&larr;', 'next_text' => '&rarr;']); ?>
          </div>

        <?php else : ?>

          <div class="no-results-page">
            <p class="error-code">0</p>
            <h2><?php esc_html_e('Nothing found', 'prime-blog'); ?></h2>
            <p><?php esc_html_e('No posts match this archive. Try searching below.', 'prime-blog'); ?></p>
            <?php get_search_form(); ?>
          </div>

        <?php endif; ?>
      </div><!-- .main-column -->

      <?php get_sidebar(); ?>

    </div><!-- .content-with-sidebar -->
  </div>
</div>

<?php get_footer(); ?>
