<?php get_header(); ?>

<div class="page-hero">
  <div class="container">
    <p class="hero-tag">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
        <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
      </svg>
      <?php esc_html_e('Search', 'prime-blog'); ?>
    </p>
    <h1>
      <?php
        printf(
          esc_html__('Results for: %s', 'prime-blog'),
          '<span class="text-accent">' . esc_html(get_search_query()) . '</span>'
        );
      ?>
    </h1>
    <?php if ( have_posts() ) : ?>
      <p class="hero-desc">
        <?php
          global $wp_query;
          printf(
            esc_html(_n('%s result found', '%s results found', $wp_query->found_posts, 'prime-blog')),
            number_format_i18n($wp_query->found_posts)
          );
        ?>
      </p>
    <?php endif; ?>
  </div>
</div>

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
          </div>

          <div class="pagination">
            <?php echo paginate_links(['mid_size' => 2, 'prev_text' => '&larr;', 'next_text' => '&rarr;']); ?>
          </div>

        <?php else : ?>
          <div class="no-results-page">
            <p class="error-code" aria-hidden="true">?</p>
            <h2><?php esc_html_e('No results found', 'prime-blog'); ?></h2>
            <p><?php esc_html_e('Try different keywords or browse the categories.', 'prime-blog'); ?></p>
            <?php get_search_form(); ?>
          </div>
        <?php endif; ?>

      </div>
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
