<?php get_header();
$post_id = get_the_id();
$post = get_post($post_id);
$post_date = $post->post_date;
$author_id = $post->post_author;
$author_name = get_the_author_meta('display_name', $author_id);
$categories = get_the_category($post_id);
$arr_cat_id = array();
$arr_cat_slug = array();
foreach ($categories as $category) {
    array_push($arr_cat_id, $category->term_id);
    array_push($arr_cat_slug, $category->slug);
}
$args = array(
    'category__in' => $arr_cat_id,
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 6,
    'post__not_in' => array($post_id),
);
$posts = new WP_Query($args);
?>
<div id="content" class="site-content">
    <div class="breadcrumb"
        style="--overlay-breadcrumb-left: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-left.png'; ?>'); --overlay-breadcrumb-right:url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-right.png'; ?>');">
        <span class="breadcrumb-title"><?php wp_title(''); ?></span>
        <?php get_breadcrumb(); ?>
    </div>
    <main id="main" class="site-main">
        <?php get_breadcrumb(); ?>
        <div class="article-container">
            <ul class="socials-sidebar">
                <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php esc_attr_e(get_the_permalink($post_id)); ?>"
                        target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/assets/icon/fb-secondary.svg'; ?>"
                            alt="social icon" class="social-icon" />
                    </a>
                </li>
                <li>
                    <a href="<?php esc_attr_e(get_the_permalink($post_id)); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/assets/icon/tt-secondary.svg'; ?>"
                            alt="social icon" class="social-icon" />
                    </a>
                </li>
                <li>
                    <a href="http://pinterest.com/pin/create/button/?url=<?php esc_attr_e(get_the_permalink($post_id)); ?>"
                        target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/assets/icon/pinterest-secondary.svg'; ?>"
                            alt="social icon" class="social-icon" />
                    </a>
                </li>
                <li>
                    <a href="http://twitter.com/share?url=<?php esc_attr_e(get_the_permalink($post_id)); ?>"
                        target="_blank">
                        <img src="<?php echo get_template_directory_uri() . '/assets/icon/tw-secondary.svg'; ?>"
                            alt="social icon" class="social-icon" />
                    </a>
                </li>
            </ul>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <div class="post-meta">
                        <img src="<?php echo (get_template_directory_uri() . '/assets/icon/calendar-date-icon.svg'); ?>"
                            alt="calendar icon">
                        <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?> By</span>
                        <span class="author-name"><?php esc_html_e($author_name); ?></span>
                    </div>
                    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header>
                <div class="entry-content">
                    <?php
                    the_content();
                    ?>
                </div>
                <?php if (in_array('tin-tuyen-dung', $arr_cat_slug)): ?>
                    <a class="btn-apply"><?php esc_html_e('Ứng tuyển ngay', 'genplus-media'); ?></a>
                <?php endif; ?>
            </article>
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
                                <img src="<?php echo !empty($thumbnail) ? $thumbnail : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                                    alt="thumbnail" loading="lazy">
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <img src="<?php echo (get_template_directory_uri() . '/assets/icon/calendar-date-icon.svg'); ?>"
                                        alt="calendar icon">
                                    <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?> By</span>
                                    <span class="author-name"><?php esc_html_e($author_name); ?></span>
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
    </main><!-- #main -->
</div>
<?php get_footer(); ?>