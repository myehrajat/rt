<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */



if (post_password_required()) {
    return;
}
?>
<div class="comments">
    <h4 class='edited' id='edited_CommentsComments'><?php  esc_html_e('Comments', 'rentit') ?>
        (<?php echo esc_html(get_comments_number()); ?>):</h4>

    <div class="reviews open">
        <?php if (have_comments()) : ?>
            <?php
            //show comments
            wp_list_comments(array(
                'walker' => new rentit_comment_walker(),
                'type' => 'comment',
                'style' => '',
            ));
            ?>
            <?php
        endif;
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
            ?>
            <p class="no-comments"><?php  esc_html_e('Comments are closed.', 'rentit'); ?></p>
        <?php endif;
        ?>
    </div>

</div><!-- .comments-area -->
<div class="comments-form">
    <h4 class="block-title">
        <?php  esc_html_e('Submit Your Comment', 'rentit'); ?>
    </h4>

    <div class="write_comment">
        <div id="comments-form">
            <?php
            //We get the option to comment form
            $req = sanitize_text_field(get_option('require_name_email'));
            $aria_req = ($req ? " aria-required='true'" : '');
            $html_req = ($req ? " required='required'" : '');
            $html5 = 'html5';
            $args = array(
                'fields' => array(
                    'author' => '<div class="form-group">
<input type="text" placeholder="' . esc_html__("Your name and surname", "rentit") . '"
class="form-control" title="'. esc_html__('Your name and surname','rentit').'"
                    name="author""></div>',
                    'email' => '<div class="form-group">
<input type="text" placeholder="' . esc_html__("Your email adress", "rentit") . '" class="form-control"
title="' . esc_html__("Your email adress", "rentit") . '"
                    name="email""></div>',
                ),
                'comment_field' => '<div class="form-group">
<textarea placeholder="' . esc_html__("Your message", "rentit") . '" class="form-control"

title="' . esc_html__("Your message", "rentit") . '" name="comment" rows="6"></textarea>
                                </div>',
                'comment_notes_after' => '',
                'id_form' => 'comments-form',
                'id_submit' => 'submit',
                'title_reply' => esc_html__('', 'rentit'),
                'title_reply_to' => esc_html__('', 'rentit'),
                'cancel_reply_link' => esc_html__('Cancel reply', 'rentit'),
                'label_submit' => esc_html__('Post Comment', 'rentit'),
                'class_submit' => 'submit', // class  submit.
                'submit_button' => '<div class="form-group">
                                        <button type="submit" class="btn btn-theme btn-theme-transparent btn-icon-left" id="submit"><i class="fa fa-comment"></i>
                                         ' . esc_html__('Send Comment' . 'rentit') . '
                                    </button>
                                    </div>
                ', // format submit.
                'submit_field' => '<div>%1$s %2$s</div>',
                // Format button submit% 1s - button% 2s - hidden fields.
            );


           
            comment_form($args);
            ?>
        </div>
    </div>
</div>



