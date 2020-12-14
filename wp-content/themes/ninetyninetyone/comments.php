<?php

Admin\View::comment_form_utils();

// Add to your theme's comments.php
	$comment_args = array(
        'class_submit' => 'btn btn-primary submit',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true" required="required"></textarea></p>',
        'fields' => array
        (
            'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="author" name="author" class="form-control" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' . '<input id="email" name="email" class="form-control" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' . '<input id="url" name="url" class="form-control" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
        )
	);

$count = absint(get_comments_number());

if (comments_open())
{
    comment_form($comment_args);
}

if ($count > 0): ?>
<h2 class="pt-3"><?= $count ?> Commentaire<?= $count > 1 ? 's' : '' ?></h2>
<?php else: ?>
<h2>Laisser un commentaire</h2>
<?php endif;

?>

<ol class="medias py-md-2 my-md-2 px-sm-0 mx-sm-0">

<?php 

  wp_list_comments( array(
      'style'         => 'ol',
      'max_depth'     => 4,
      'short_ping'    => true,
      'avatar_size'   => '50',
      'walker'        => new ninetyninetyone\CommentWalker,
  ) );
?>
</ol>

<?php paginate_comments_links() ?>