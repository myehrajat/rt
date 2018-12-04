<?php
class rentit_comment_walker extends Walker_Comment
{
    var $tree_type = 'comment';
    var $db_fields = array('parent' => 'comment_parent', 'id' => 'comment_ID');
// constructor – wrapper for the comments list
    function __construct()
    { ?>
        <section class="comments-list">
    <?php }
    // start_lvl  wrapper for child comments list
function start_lvl(&$output, $depth = 0, $args = array())
{
    $GLOBALS['comment_depth'] = $depth + 2; ?>
    <section class="child-comments comments-list">
<?php }
    // end_lvl  closing wrapper for child comments list
function end_lvl(&$output, $depth = 0, $args = array())
{
    $GLOBALS['comment_depth'] = $depth + 2; ?>
    </section>
<?php }
// start_el  HTML for comment template
function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
{
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment'] = $comment;
    $parent_class = (empty($args['has_children']) ? '' : 'parent');
    if ('article' == $args['style']) {
        $tag = 'article';
        $add_below = 'comment';
    } else {
        $tag = 'article';
        $add_below = 'comment';
    } ?>
    <article <?php comment_class(empty($args['has_children']) ? ' media comment' : 'parent media comment') ?>
        id="comment-<?php comment_ID() ?>" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
    <a href="#" class="pull-left comment-avatar">
        <?php if (function_exists("get_avatar")) echo  wp_kses_post(get_avatar($comment, 70)); ?>
    </a>
    <div class="media-body">
        <p class="comment-meta">
            <span class="comment-author">
                <a href="#">
                    <?php comment_author();
                    ?>
                </a>
                <span class="comment-date">
                    <?php
                    echo esc_html(human_time_diff(strtotime(get_comment_date()), current_time('timestamp'))) . " " . esc_html__('Ago', 'rentit');
                    if (isset($_COOKIE['comentid' . get_comment_ID()])) {
                        $class = "";
                    } else {
                        $class = "flag_grey";
                    }
                    ?>
                    <i data-id="<?php echo esc_html(get_comment_ID()); ?>" class="fa fa-flag <?php  echo esc_attr( $class); ?>"></i>
                </span></span></p>
        <p class="comment-text">
            <?php echo esc_html(get_comment_text()); ?>
        </p>
        <p class="comment-reply">
            <?php
            $args['reply_text'] = "Reply this comment";
            comment_reply_link(array_merge($args, array('add_below' => sanitize_text_field($add_below), 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            <?php
            ob_start();
            comment_reply_link(array_merge($args, array('add_below' =>  sanitize_text_field($add_below), 'depth' => $depth, 'max_depth' => $args['max_depth'])));
            $link = ob_get_clean();
            preg_match_all('#href=[\',"](.*?)[\',"]#', $link, $math);
            ?>
            <a href="<?php echo @esc_url($math[1][0]); ?>">
                <i
                    class="fa fa-comment"></i>
            </a>
            <?php edit_comment_link('<p class="comment-meta-item">' . esc_html__('Edit this comment', 'rentit') . '</p>', '', ''); ?>
            <?php if ($comment->comment_approved == '0') : ?>
        <p class="comment-meta-item"><?php echo esc_html__('Your comment is awaiting moderation.', 'rentit') ?></p>
        <?php endif; ?>
        </p>
    </div>
<?php }
    // end_el  closing HTML for comment template
function end_el(&$output, $comment, $depth = 0, $args = array())
{ ?>
    </article>
<?php }
// destructor  closing wrapper for the comments list
    function __destruct()
    { ?>
        </section>
    <?php }
}