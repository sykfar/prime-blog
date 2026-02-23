<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

  <!-- Featured image hero -->
  <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-hero">
      <?php the_post_thumbnail( 'prime-hero', [ 'alt' => get_the_title() ] ); ?>
    </div>
  <?php endif; ?>

  <div class="content-container">

    <!-- Post header -->
    <header class="single-header">

      <!-- All category pills – each in its own configured colour -->
      <div class="post-category-pills">
        <?php prime_blog_post_tag(); ?>
      </div>

      <!-- Date & reading time on a separate row -->
      <div class="post-meta">
        <time class="post-date" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
        <span class="post-meta-dot"></span>
        <?php prime_blog_reading_time(); ?>
      </div>

      <h1><?php the_title(); ?></h1>

      <?php if ( has_excerpt() ) : ?>
        <p class="post-excerpt"><?php the_excerpt(); ?></p>
      <?php endif; ?>

      <div class="post-footer-meta">
        <?php prime_blog_author_meta(); ?>

        <!-- Share bar (networks configured in Customizer → Prime Blog → Share Buttons) -->
        <?php prime_blog_share_bar(); ?>
      </div>
    </header>

    <!-- Post content -->
    <div class="entry-content">
      <?php
        the_content();
        wp_link_pages( [
          'before'      => '<nav class="page-links" aria-label="' . esc_attr__( 'Post pages', 'prime-blog' ) . '"><span class="page-links-title">' . esc_html__( 'Pages:', 'prime-blog' ) . '</span>',
          'after'       => '</nav>',
          'link_before' => '<span class="page-number">',
          'link_after'  => '</span>',
        ] );
      ?>
    </div>

    <!-- Post tags -->
    <?php
      $tags = get_the_tags();
      if ( $tags ) :
    ?>
      <div class="post-tags-list" aria-label="<?php esc_attr_e('Post tags', 'prime-blog'); ?>">
        <?php foreach ( $tags as $tag ) : ?>
          <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Author bio -->
    <div class="author-bio">
      <?php echo get_avatar( get_the_author_meta('ID'), 64, '', '', ['class' => 'author-bio-avatar'] ); ?>
      <div class="author-bio-content">
        <h4>
          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>">
            <?php the_author(); ?>
          </a>
        </h4>
        <?php if ( get_the_author_meta('description') ) : ?>
          <p><?php echo esc_html( get_the_author_meta('description') ); ?></p>
        <?php else : ?>
          <p><?php esc_html_e('Author at', 'prime-blog'); ?> <?php bloginfo('name'); ?>.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Related posts -->
    <?php
      $categories = get_the_category();
      if ( $categories ) :
        $cat_id = $categories[0]->term_id;
        $related = new WP_Query([
          'category__in'        => [ $cat_id ],
          'post__not_in'        => [ get_the_ID() ],
          'posts_per_page'      => 3,
          'ignore_sticky_posts' => true,
        ]);
        if ( $related->have_posts() ) :
    ?>
      <section class="related-posts" aria-label="<?php esc_attr_e('Related posts', 'prime-blog'); ?>">
        <h3><?php esc_html_e('Related Posts', 'prime-blog'); ?></h3>
        <div class="posts-grid">
          <?php while ( $related->have_posts() ) : $related->the_post(); ?>
            <article class="post-card">
              <?php if ( has_post_thumbnail() ) : ?>
                <a class="post-card-image-wrap" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
                  <?php the_post_thumbnail('prime-card', ['alt' => get_the_title()]); ?>
                </a>
              <?php else : ?>
                <div class="post-card-no-image">
                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
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
                <h3 class="post-card-title">
                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>
                <div class="post-card-footer">
                  <?php prime_blog_author_meta(); ?>
                  <?php prime_blog_reading_time(); ?>
                </div>
              </div>
            </article>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </section>
    <?php endif; endif; ?>

    <!-- Comments -->
    <?php
      if ( comments_open() || get_comments_number() ) :
        echo '<div class="comments-section">';
        comments_template();
        echo '</div>';
      endif;
    ?>

  </div><!-- .content-container -->

<?php endwhile; ?>

<?php get_footer(); ?>
