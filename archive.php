<?php get_header(); ?>
<div id="content" class="site-content">
    <div class="breadcrumb"
        style="--overlay-breadcrumb-left: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-left.png'; ?>'); --overlay-breadcrumb-right:url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-right.png'; ?>');">
        <h1 class="breadcrumb-title"><?php echo single_term_title(); ?></h1>
    </div>
    <main id="main" class="site-main"
        style="--overlay-page: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-page-min.png'; ?>');">
        <div class="posts-wrapper">
            <div class="list-posts">
                <?php global $wp_query;
                $my_posts = $wp_query->posts;
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
                                <img src="<?php esc_attr_e(!empty($featured_img_url) ? $featured_img_url : (get_template_directory_uri() . '/assets/images/placeholder-default.png')); ?>" alt="featured image" class="featured-image" loading="lazy" />
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
                                <img src="<?php echo (get_template_directory_uri() . '/assets/icon/calendar-date-icon.svg'); ?>" alt="calendar icon" loading="lazy">
                                <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?> By</span>
                                <a href="<?php echo get_author_posts_url($author_id); ?>" class="author-name"><?php esc_html_e($author_name); ?></a>
                            </div>
                            <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>" class="read-more">
                                <?php esc_html_e('Xem thêm', 'genplus-media'); ?>
                                <img src="<?php echo (get_template_directory_uri() . '/assets/icon/arrow-right-circle.svg'); ?>" alt="calendar icon" loading="lazy">
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
                        'total' => $wp_query->max_num_pages,
                        'prev_next' => true,
                        'prev_text' => sprintf('&#129120;', __('Newer Posts', 'genplus-media')),
                        'next_text' => sprintf('&#129122;', __('Older Posts', 'genplus-media')),
                        'mid_size'  => 2,
                    )
                );
                ?>
            </div>
        </div>
    </main><!-- #main -->
</div>
<?php get_footer(); ?>