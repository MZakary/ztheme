<?php
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
                _nx( '%1$s Comment', '%1$s Comments', $count, 'comments title', 'ztheme' ),
                number_format_i18n( $count )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 48,
            ) );
            ?>
        </ol>

        <?php
        // Comment navigation
        the_comments_navigation();
        ?>

    <?php endif; // have_comments() ?>

    <?php
    // Comment form
    comment_form();
    ?>

</div>