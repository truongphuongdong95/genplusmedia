<?php get_header();
global $wp_query;
$current_auth = $wp_query->get_queried_object();
$author_id = $current_auth->ID;
$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
$args = array(
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'order' => 'DESC',
    'orderby' => 'date',
    'author' => $author_id,
    'paged' => $paged
);
$query = new WP_Query($args);
$my_posts = $query->posts;
$total_posts = count($my_posts);
?>
<div id="content" class="site-content">
    <main id="main" class="site-main"
        style="--overlay-page: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-page-min.png'; ?>');">
        <div class="posts-wrapper">
            <div class="author-wrapper">
                <div class="author-avatar">
                    <?php echo get_avatar($author_id, 100, '', $current_auth->user_login); ?>
                </div>
                <div class="author-info">
                    <h2 class="author-name"><?php esc_html_e($current_auth->user_login, 'genplus-media'); ?></h2>
                    <p class="author-description"><?php esc_html_e(the_author_meta('description', $author_id)); ?>
                    </p>
                </div>
            </div>
            <?php if (isset($my_posts) && $total_posts > 0): ?>
                <div class="list-posts">
                    <h3 class="total-posts"><?php esc_html_e('Tất cả bài viết (' . $total_posts . ')', 'genplus-media'); ?></h3>
                    <?php
                    foreach ($my_posts as $key => $post) {
                        $post_id = $post->ID;
                        $title = $post->post_title;
                        $post_description = get_the_content($post_id);
                        $post_date = $post->post_date;
                        $author_id = $post->post_author;
                        $author_name = get_the_author_meta('display_name', $author_id);
                        $featured_img_url = get_the_post_thumbnail_url($post_id, 'full');
                        ?>
                        <div class="post-item">
                            <div class="post-thumb">
                                <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>">
                                    <img src="<?php esc_attr_e(!empty($featured_img_url) ? $featured_img_url : (get_template_directory_uri() . '/assets/images/placeholder-default.png')); ?>"
                                        alt="featured image" class="featured-image" loading="lazy" />
                                </a>
                            </div>
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>">
                                        <?php esc_html_e($title); ?>
                                    </a>
                                </h2>
                                <p class="post-description">
                                    <?php echo wp_strip_all_tags(wp_trim_words($post_description)); ?>
                                </p>
                                <div class="post-meta">
                                    <img src="<?php echo (get_template_directory_uri() . '/assets/icon/calendar-date-icon.svg'); ?>"
                                        alt="calendar icon" loading="lazy">
                                    <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?> By</span>
                                    <a href="<?php echo get_author_posts_url($author_id); ?>"
                                        class="author-name"><?php esc_html_e($author_name); ?></a>
                                </div>
                                <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>" class="read-more">
                                    <?php esc_html_e('Xem thêm', 'genplus-media'); ?>
                                    <img src="<?php echo (get_template_directory_uri() . '/assets/icon/arrow-right-circle.svg'); ?>"
                                        alt="more icon" loading="lazy">
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class='pagination'>
                    <?php
                    $big = 999999999;
                    echo paginate_links(
                        array(
                            'base' => str_replace($big, '%#%', get_pagenum_link($big)),
                            'format' => '?paged=%#%',
                            'current' => max(1, get_query_var('paged')),
                            'total' => $query->max_num_pages,
                            'prev_next' => true,
                            'prev_text' => sprintf('', __('Newer Posts', 'genplus-media')),
                            'next_text' => sprintf('', __('Older Posts', 'genplus-media')),
                            'mid_size' => 2,
                        )
                    );
                    ?>
                </div>
            <?php else: ?>
                <?php esc_html_e('Không có bài viết nào!', 'genplus-media'); ?>
            <?php endif; ?>
        </div>
    </main><!-- #main -->
</div>
<?php get_footer(); ?>