<?php
/**
 * Template for displaying comments.
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

  <?php if ( have_comments() ) : ?>

    <h2 class="comments-title">
      <?php
        $count = get_comments_number();
        printf(
            /* translators: %1$s: comment count, %2$s: post title */
            esc_html( _nx(
                '%1$s Comment on &ldquo;%2$s&rdquo;',
                '%1$s Comments on &ldquo;%2$s&rdquo;',
                $count,
                'comments title',
                'prime-blog'
            ) ),
            number_format_i18n( $count ),
            '<span>' . get_the_title() . '</span>'
        );
      ?>
    </h2>

    <ol class="comment-list">
      <?php
        wp_list_comments( [
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 48,
            'callback'    => null,
        ] );
      ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
      <nav class="comment-navigation" aria-label="<?php esc_attr_e( 'Comment navigation', 'prime-blog' ); ?>">
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'prime-blog' ) ); ?></div>
        <div class="nav-paging"><?php paginate_comments_links(); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'prime-blog' ) ); ?></div>
      </nav>
    <?php endif; ?>

  <?php endif; ?>

  <?php
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>
    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'prime-blog' ); ?></p>
  <?php endif; ?>

  <?php comment_form(); ?>

</div><!-- #comments -->
