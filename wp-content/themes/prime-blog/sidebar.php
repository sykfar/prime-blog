<aside class="sidebar" role="complementary" aria-label="<?php esc_attr_e('Sidebar', 'prime-blog'); ?>">

  <?php if ( is_active_sidebar('sidebar-1') ) : ?>
    <?php dynamic_sidebar('sidebar-1'); ?>

  <?php else : ?>
    <!-- Default sidebar content -->

    <!-- About widget -->
    <section class="widget">
      <h3 class="widget-title"><?php esc_html_e('About', 'prime-blog'); ?></h3>
      <p style="font-size:.9375rem;color:var(--text-muted);line-height:1.7;">
        <?php echo esc_html( get_bloginfo('description') ?: __('A blog about ideas, guides, and stories worth reading.', 'prime-blog') ); ?>
      </p>
    </section>

    <!-- Categories -->
    <section class="widget">
      <h3 class="widget-title"><?php esc_html_e('Categories', 'prime-blog'); ?></h3>
      <ul>
        <?php
          wp_list_categories([
            'title_li'   => '',
            'show_count' => true,
            'hide_empty' => true,
            'orderby'    => 'count',
            'order'      => 'DESC',
            'number'     => 8,
          ]);
        ?>
      </ul>
    </section>

    <!-- Recent posts -->
    <section class="widget">
      <h3 class="widget-title"><?php esc_html_e('Recent Posts', 'prime-blog'); ?></h3>
      <?php
        $recent = new WP_Query(['posts_per_page' => 5, 'ignore_sticky_posts' => true]);
        if ( $recent->have_posts() ) :
      ?>
        <ul>
          <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
            <li style="display:flex;gap:.75rem;align-items:flex-start;padding:.625rem 0;border-bottom:1px solid var(--border-soft);">
              <?php if ( has_post_thumbnail() ) : ?>
                <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1" style="flex-shrink:0;">
                  <?php the_post_thumbnail('prime-thumb', ['style' => 'width:52px;height:52px;object-fit:cover;border-radius:6px;', 'alt' => '']); ?>
                </a>
              <?php endif; ?>
              <div>
                <a href="<?php the_permalink(); ?>" style="font-size:.9rem;font-weight:600;color:var(--text);line-height:1.4;display:block;margin-bottom:.25rem;"><?php the_title(); ?></a>
                <time style="font-size:.8rem;color:var(--text-subtle);" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
              </div>
            </li>
          <?php endwhile; wp_reset_postdata(); ?>
        </ul>
      <?php endif; ?>
    </section>

    <!-- Tags cloud -->
    <section class="widget">
      <h3 class="widget-title"><?php esc_html_e('Tags', 'prime-blog'); ?></h3>
      <div style="display:flex;flex-wrap:wrap;gap:.375rem;">
        <?php
          $tags = get_tags(['number' => 20, 'orderby' => 'count', 'order' => 'DESC']);
          if ( $tags ) {
            foreach ($tags as $tag) {
              printf(
                '<a class="post-tags-list" href="%s" style="font-size:.8125rem;padding:.3rem .7rem;border-radius:999px;background:var(--bg-soft);border:1px solid var(--border);color:var(--text-muted);display:inline-flex;transition:color .2s,border-color .2s;">%s</a>',
                esc_url(get_tag_link($tag->term_id)),
                esc_html($tag->name)
              );
            }
          }
        ?>
      </div>
    </section>

  <?php endif; ?>

</aside>
