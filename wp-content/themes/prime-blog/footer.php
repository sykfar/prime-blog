</main><!-- #main-content -->

<!-- ===== SITE FOOTER ===== -->
<footer class="site-footer" role="contentinfo">
  <div class="container">

    <!-- Widget columns -->
    <div class="footer-widgets">

      <!-- Brand column -->
      <div class="footer-brand">
        <a class="logo-text" href="<?php echo esc_url( home_url('/') ); ?>" rel="home">
          <?php
            $name  = get_bloginfo('name');
            $parts = preg_split('/\s+/', trim($name), 2);
            if ( count($parts) === 2 ) {
              echo esc_html($parts[0]) . '<span>' . esc_html($parts[1]) . '</span>';
            } else {
              echo '<span>' . esc_html($name) . '</span>';
            }
          ?>
        </a>
        <p><?php echo esc_html( get_bloginfo('description') ?: __('A modern blog sharing ideas, guides, and stories worth reading.', 'prime-blog') ); ?></p>

        <!-- Social links -->
        <div class="social-links">
          <!-- Add/edit social links in Customizer or directly here -->
          <?php $twitter = get_theme_mod('prime_twitter', ''); ?>
          <?php if ($twitter) : ?>
          <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener noreferrer" aria-label="Twitter / X">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.259 5.63zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <?php endif; ?>

          <a href="<?php echo esc_url( get_feed_link() ); ?>" aria-label="RSS Feed">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 11a9 9 0 0 1 9 9"></path><path d="M4 4a16 16 0 0 1 16 16"></path><circle cx="5" cy="19" r="1"></circle></svg>
          </a>
        </div>
      </div>

      <!-- Footer widget area 2 -->
      <div class="footer-col">
        <?php if ( is_active_sidebar('footer-2') ) : ?>
          <?php dynamic_sidebar('footer-2'); ?>
        <?php else : ?>
          <h4 class="footer-widget-title"><?php esc_html_e('Explore', 'prime-blog'); ?></h4>
          <div class="footer-widget-links">
            <?php
              wp_list_categories([
                'title_li'   => '',
                'number'     => 6,
                'orderby'    => 'count',
                'order'      => 'DESC',
                'hide_empty' => true,
              ]);
            ?>
          </div>
        <?php endif; ?>
      </div>

      <!-- Footer widget area 3 -->
      <div class="footer-col">
        <?php if ( is_active_sidebar('footer-3') ) : ?>
          <?php dynamic_sidebar('footer-3'); ?>
        <?php else : ?>
          <h4 class="footer-widget-title"><?php esc_html_e('Company', 'prime-blog'); ?></h4>
          <nav class="footer-widget-links" aria-label="<?php esc_attr_e('Footer navigation', 'prime-blog'); ?>">
            <?php
              wp_nav_menu([
                'theme_location' => 'footer',
                'container'      => false,
                'menu_class'     => '',
                'depth'          => 1,
                'fallback_cb'    => function() {
                  $pages = get_pages(['sort_column' => 'menu_order', 'number' => 5]);
                  foreach ($pages as $page) {
                    echo '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html($page->post_title) . '</a>';
                  }
                },
                'items_wrap' => '%3$s',
                'walker'     => new class extends Walker_Nav_Menu {
                  public function start_el(&$output, $item, $depth=0, $args=null, $id=0) {
                    $output .= '<a href="' . esc_attr($item->url) . '">' . esc_html($item->title) . '</a>';
                  }
                  public function end_el(&$output, $item, $depth=0, $args=null) {}
                  public function start_lvl(&$output, $depth=0, $args=null) {}
                  public function end_lvl(&$output, $depth=0, $args=null) {}
                },
              ]);
            ?>
          </nav>
        <?php endif; ?>
      </div>

      <!-- Footer column 4: Account / Community -->
      <div class="footer-col footer-col-account">
        <?php if ( is_user_logged_in() ) : ?>
          <?php
            $current_user = wp_get_current_user();
            $profile_url  = function_exists( 'bp_loggedin_user_link' )
              ? bp_loggedin_user_link()
              : get_author_posts_url( $current_user->ID );
          ?>
          <h4 class="footer-widget-title"><?php esc_html_e( 'Community', 'prime-blog' ); ?></h4>

          <div class="footer-user-info">
            <a href="<?php echo esc_url( $profile_url ); ?>">
              <?php echo get_avatar( $current_user->ID, 32, '', esc_attr( $current_user->display_name ), [ 'class' => 'footer-avatar' ] ); ?>
              <span><?php echo esc_html( $current_user->display_name ); ?></span>
            </a>
          </div>

          <nav class="footer-widget-links" aria-label="<?php esc_attr_e( 'Community navigation', 'prime-blog' ); ?>">
            <?php if ( function_exists( 'buddypress' ) ) : ?>
              <?php if ( bp_is_active( 'activity' ) ) : ?>
                <a href="<?php echo esc_url( bp_get_activity_directory_permalink() ); ?>">
                  <?php esc_html_e( 'Activity', 'prime-blog' ); ?>
                </a>
              <?php endif; ?>
              <a href="<?php echo esc_url( $profile_url ); ?>">
                <?php esc_html_e( 'My Profile', 'prime-blog' ); ?>
              </a>
              <?php if ( bp_is_active( 'groups' ) ) : ?>
                <a href="<?php echo esc_url( bp_get_groups_directory_permalink() ); ?>">
                  <?php esc_html_e( 'Groups', 'prime-blog' ); ?>
                </a>
              <?php endif; ?>
              <?php if ( bp_is_active( 'members' ) ) : ?>
                <a href="<?php echo esc_url( bp_get_members_directory_permalink() ); ?>">
                  <?php esc_html_e( 'Members', 'prime-blog' ); ?>
                </a>
              <?php endif; ?>
              <hr class="footer-divider">
            <?php endif; ?>
            <?php if ( current_user_can( 'manage_options' ) ) : ?>
              <a href="<?php echo esc_url( admin_url() ); ?>">
                <?php esc_html_e( 'Dashboard', 'prime-blog' ); ?>
              </a>
            <?php endif; ?>
            <a class="footer-logout" href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>">
              <?php esc_html_e( 'Log Out', 'prime-blog' ); ?>
            </a>
          </nav>

        <?php else : ?>
          <h4 class="footer-widget-title"><?php esc_html_e( 'Account', 'prime-blog' ); ?></h4>

          <nav class="footer-widget-links" aria-label="<?php esc_attr_e( 'Account navigation', 'prime-blog' ); ?>">
            <a href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>">
              <?php esc_html_e( 'Log In', 'prime-blog' ); ?>
            </a>
            <?php if ( get_option( 'users_can_register' ) ) : ?>
              <a href="<?php echo esc_url( wp_registration_url() ); ?>">
                <?php esc_html_e( 'Register', 'prime-blog' ); ?>
              </a>
            <?php endif; ?>
          </nav>
        <?php endif; ?>
      </div>

    </div><!-- .footer-widgets -->

    <!-- Bottom bar -->
    <div class="footer-bottom">
      <p class="footer-copyright">
        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.
        <?php esc_html_e('All rights reserved.', 'prime-blog'); ?>
      </p>

      <nav class="footer-bottom-links" aria-label="<?php esc_attr_e('Legal navigation', 'prime-blog'); ?>">
        <?php
          $privacy = get_privacy_policy_url();
          if ($privacy) {
            echo '<a href="' . esc_url($privacy) . '">' . esc_html__('Privacy Policy', 'prime-blog') . '</a>';
          }
        ?>
      </nav>
    </div>

  </div><!-- .container -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
