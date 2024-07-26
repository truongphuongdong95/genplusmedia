<?php get_header();
$args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 6,
);
$posts = new WP_Query($args);
?>
<div id="content" class="site-content">
    <div class="breadcrumb"
        style="--overlay-breadcrumb-left: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-left.png'; ?>'); --overlay-breadcrumb-right:url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-right.png'; ?>');">
        <h1 class="breadcrumb-title"><?php wp_title(''); ?></h1>
    </div>
    <main id="main" class="site-main">
        <div class="not-found-container">
            <div class="not-found-wrapper">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/404.png'; ?>" alt="404"
                    class="image-404" />
                <h2 class="heading">Bài viết không tồn tại</h2>
            </div>
            <?php if ($posts->have_posts()): ?>
                <div class="related-posts">
                    <h2 class="title"><?php esc_html_e('Bài viết khác', 'genplus-media'); ?></h2>
                    <div class="list-posts">
                        <?php while ($posts->have_posts()):
                            $posts->the_post();
                            $post = $posts->post; // WP_Post object
                            $post_id = $post->ID;
                            $title = $post->post_title;
                            $post_date = $post->post_date;
                            $author_id = $post->post_author;
                            $author_name = get_the_author_meta('display_name', $author_id);
                            $thumbnail = get_the_post_thumbnail_url($post_id);
                            ?>
                            <div class="post-item">
                                <div class="post-thumb">
                                    <a href="<?php esc_attr_e(get_the_permalink($post_id)); ?>">
                                        <img src="<?php echo !empty($thumbnail) ? $thumbnail : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                                        alt="thumbnail" loading="lazy">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <div class="post-meta">
                                        <img src="<?php echo (get_template_directory_uri() . '/assets/icon/calendar-date-icon.svg'); ?>"
                                            alt="calendar icon">
                                        <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?>
                                            By</span>
                                        <a href="<?php echo get_author_posts_url($author_id); ?>" class="author-name"><?php esc_html_e($author_name); ?></a>
                                    </div>
                                    <a href="<?php esc_attr_e(get_the_permalink($post_id)); ?>">
                                        <h2 class="post-title"><?php esc_html_e($title); ?>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php
                        wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </main><!-- #main -->
</div>
<?php get_footer(); ?>