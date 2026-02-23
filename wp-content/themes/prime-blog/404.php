<?php get_header(); ?>

<div class="container">
  <div class="no-results-page">
    <p class="error-code" aria-hidden="true">404</p>
    <h2><?php esc_html_e('Page not found', 'prime-blog'); ?></h2>
    <p><?php esc_html_e('The page you\'re looking for doesn\'t exist or has been moved.', 'prime-blog'); ?></p>
    <div style="display:flex;gap:1rem;flex-wrap:wrap;justify-content:center;margin-top:1rem;">
      <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Go home', 'prime-blog'); ?></a>
      <a class="btn btn-outline" href="<?php echo esc_url(home_url('/blog')); ?>"><?php esc_html_e('Browse posts', 'prime-blog'); ?></a>
    </div>
    <div style="width:100%;max-width:440px;margin-top:2rem;">
      <?php get_search_form(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
