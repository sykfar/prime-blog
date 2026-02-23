<aside class="sidebar bp-sidebar" role="complementary">
  <?php if ( is_active_sidebar('bp-sidebar') ) : ?>
    <?php dynamic_sidebar('bp-sidebar'); ?>
  <?php else : ?>
    <!-- Default: member search widget -->
    <section class="widget">
      <h3 class="widget-title"><?php esc_html_e('Find Members', 'prime-blog'); ?></h3>
      <?php get_search_form(); ?>
    </section>
  <?php endif; ?>
</aside>
