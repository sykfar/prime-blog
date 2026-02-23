<?php get_header(); ?>

<?php if ( is_home() && ! is_front_page() ) : ?>
  <!-- Blog listing page -->
  <div class="page-hero">
    <div class="container">
      <p class="section-label"><?php esc_html_e('Latest', 'prime-blog'); ?></p>
      <h1><?php single_post_title( '', true ); ?></h1>
    </div>
  </div>

<?php elseif ( is_front_page() && is_home() ) : ?>
  <!-- Home page with featured post -->
  <?php
    $featured = new WP_Query([
      'posts_per_page'      => 1,
      'ignore_sticky_posts' => false,
      'meta_query'          => [
        [
          'key'     => '_thumbnail_id',
          'compare' => 'EXISTS',
        ],
      ],
    ]);
  ?>
  <?php if ( $featured->have_posts() ) : $featured->the_post(); ?>
    <div class="container" style="padding-top: 2rem;">
      <p class="section-label"><?php esc_html_e('Featured', 'prime-blog'); ?></p>
      <article class="featured-post">
        <?php if ( has_post_thumbnail() ) : ?>
          <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
            <?php the_post_thumbnail( 'prime-hero', [ 'alt' => get_the_title() ] ); ?>
          </a>
        <?php endif; ?>
        <div class="featured-post-overlay">
          <?php prime_blog_post_tag(); ?>
          <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="post-meta">
            <?php prime_blog_author_meta(); ?>
            <span class="post-meta-dot"></span>
            <time class="post-date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
            <span class="post-meta-dot"></span>
            <?php prime_blog_reading_time(); ?>
          </div>
        </div>
      </article>
    </div>
    <?php wp_reset_postdata(); ?>
  <?php endif; ?>
<?php endif; ?>

<!-- Main posts grid -->
<div class="container">
  <div class="content-with-sidebar" style="padding-top:<?php echo (is_home() && !is_front_page()) ? '2rem' : '1rem'; ?>">

    <div class="main-column">

      <?php if ( have_posts() ) : ?>

        <div class="posts-grid">
          <?php while ( have_posts() ) : the_post(); ?>

            <?php
              // Skip if this is the featured post on front page
              // (handled above already)
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
              <!-- Image -->
              <?php if ( has_post_thumbnail() ) : ?>
                <a class="post-card-image-wrap" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                  <?php the_post_thumbnail( 'prime-card', [ 'alt' => get_the_title() ] ); ?>
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

              <!-- Body -->
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

        <!-- Pagination -->
        <div class="pagination">
          <?php
            echo paginate_links([
              'mid_size'  => 2,
              'prev_text' => '&larr;',
              'next_text' => '&rarr;',
            ]);
          ?>
        </div>

      <?php else : ?>

        <div class="no-results-page">
          <p class="error-code">0</p>
          <h2><?php esc_html_e('Nothing found', 'prime-blog'); ?></h2>
          <p><?php esc_html_e('It seems we can\'t find what you\'re looking for. Try a search?', 'prime-blog'); ?></p>
          <?php get_search_form(); ?>
        </div>

      <?php endif; ?>

    </div><!-- .main-column -->

    <!-- Sidebar -->
    <?php get_sidebar(); ?>

  </div>
</div>

<?php get_footer(); ?>
