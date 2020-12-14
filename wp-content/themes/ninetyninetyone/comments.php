<?php

// Get comment arguments and HTML form
$comment_args = Admin\View::comment_form_utils();

// Comments count
$count = absint(get_comments_number());

// Comment form display
if (comments_open())
{
    comment_form($comment_args);
}

if ($count > 0): ?>
    <h3 class="pt-3"><?= $count ?> Comment<?= $count > 1 ? 's' : '' ?></h2>
<?php endif; ?>

    <?php 

    wp_list_comments( array(
        'style'         => 'ol',
        'max_depth'     => 4,
        'short_ping'    => true,
        'avatar_size'   => '50',
        'walker'        => new ninetyninetyone\CommentWalker,
    ) );
    ?>

<?php paginate_comments_links() ?>