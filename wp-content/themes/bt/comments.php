<?php
if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments-area">

  <?php
  // You can start editing here -- including this comment!
  if (have_comments()) :
    ?>
    <h2 class="comments-title">
      <?php
      $comments_number = get_comments_number();
      if ('1' === $comments_number) {
        /* translators: %s: post title */
        printf(_x('תגובה אחת למאמר &ldquo;%s&rdquo;', 'comments title', 'bt'), get_the_title());
      } else {
        printf(
                /* translators: 1: number of comments, 2: post title */
                _nx(
                        '%1$s תגובה למאמר &ldquo;%2$s&rdquo;', '%1$s תגובות למאמר &ldquo;%2$s&rdquo;', $comments_number, 'comments title', 'bt'
                ), number_format_i18n($comments_number), get_the_title()
        );
      }
      ?>
    </h2>

    <ul class="comment-list">
      <?php
      wp_list_comments(array(
          'avatar_size' => 100,
          'style' => 'ol',
          'short_ping' => true
      ));
      ?>
    </ul>

      <?php
    endif; // Check for have_comments().
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
      ?>

    <p class="no-comments"><?php _e('אין אפשרות להגיב, תגובות סגורות.', 'bt'); ?></p>
    <?php
  endif;
  $args = [
      'fields' => [
          'url' => '',
          'author' => '',
          'email' => '',
      ],
      'comment_notes_before' => '',
      'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-success font700" value="%4$s" />'
  ];
  comment_form($args);
  ?>

</div><!-- #comments -->
