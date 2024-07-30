<?php get_header(); ?>
<div id="content" class="site-content">
    <div class="breadcrumb"
        style="--overlay-breadcrumb-left: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-left.png'; ?>'); --overlay-breadcrumb-right:url('<?php echo get_template_directory_uri() . '/assets/images/overlay-breadcrumb-right.png'; ?>');">
        <h1 class="breadcrumb-title"><?php wp_title(''); ?></h1>
    </div>
    <main id="main" class="site-main"
        style="--overlay-page: url('<?php echo get_template_directory_uri() . '/assets/images/overlay-page-min.png'; ?>');">
        <div class="posts-wrapper">
            <div class="list-posts">
                <?php
                // Start the Loop.
                while (have_posts()):
                    the_post();
                    $post_id = get_the_ID();
                    $title = $post->post_title;
                    $post_description = get_the_content($post_id);
                    $post_date = $post->post_date;
                    $author_id = $post->post_author;
                    $author_name = get_the_author_meta('display_name', $author_id);
                    $featured_img_url = get_the_post_thumbnail_url($post_id, 'full');
                    ?>
                    <div id="post-<?php the_ID(); ?>" class="post-item">
                        <div class="post-thumb">
                            <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>">
                                <img src="<?php esc_attr_e(!empty($featured_img_url) ? $featured_img_url : (get_template_directory_uri() . '/assets/images/placeholder-default.png')); ?>"
                                    class="featured-image" alt="featured image" loading="lazy" />
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
                                    alt="calendar icon">
                                <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?> By</span>
                                <a href="<?php echo get_author_posts_url($author_id); ?>" class="author-name"><?php esc_html_e($author_name); ?></a>
                            </div>
                            <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>" class="read-more">
                                <?php esc_html_e('Xem thêm', 'genplus-media'); ?>
                                <img src="<?php echo (get_template_directory_uri() . '/assets/icon/arrow-right-circle.svg'); ?>"
                                    alt="more icon">
                            </a>
                        </div>
                    </div>
                    <?php
                endwhile; // End the loop.
                ?>
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
                        'prev_text' => sprintf('', __('Newer Posts', 'genplus-media')),
                        'next_text' => sprintf('', __('Older Posts', 'genplus-media')),
                        'mid_size' => 2,
                    )
                );
                ?>
                <div></div>
            </div>
        </div>
    </main><!-- #main -->

</div>
<?php get_footer(); ?>