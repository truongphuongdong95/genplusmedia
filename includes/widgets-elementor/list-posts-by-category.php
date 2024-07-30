<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_List_Posts_By_Category_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'list_posts_by_category_widget';
    }

    public function get_title()
    {
        return esc_html__('List Posts By Category', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['posts', 'list'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return [];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => esc_html__('Testimonial', 'genplus-media'),
            ]
        );

        $this->add_control(
            'number_posts',
            [
                'label' => esc_html__('Number Posts', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 99999999999,
                'step' => 1,
                'default' => 10,
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Category', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__('None', 'genplus-media'),
                    'hoat-dong' => esc_html__('Hoạt động nổi bật', 'genplus-media'),
                    'tuyen-dung' => esc_html__('Tin tuyển dụng', 'genplus-media'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('DESC', 'genplus-media'),
                    'asc' => esc_html__('ASC', 'genplus-media'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'posts-wrapper');
        ?>
        <div class="posts-container">
            <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                <div class="list-posts">
                    <?php global $wp_query;
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
                    $args = array(
                        'post_status' => 'publish',
                        'posts_per_page' => $settings['number_posts'],
                        'order' => $settings['order'],
                        'orderby' => 'date',
                        'category_name' => $settings['category'],
                        'paged' => $paged
                    );
                    $wp_query = new WP_Query($args);
                    $my_posts = $wp_query->posts;
                    foreach ($my_posts as $key => $post) {
                        $post_id = $post->ID;
                        $title = $post->post_title;
                        $post_description = $post->post_content;
                        $post_date = $post->post_date;
                        $author_id = $post->post_author;
                        $author_name = get_the_author_meta('display_name', $author_id);
                        $featured_img_url = get_the_post_thumbnail_url($post_id, 'full');
                        ?>
                        <div class="post-item">
                            <div class="post-thumb">
                                <a href="<?php esc_attr_e(get_the_permalink($post_id)); ?>">
                                    <img src="<?php esc_attr_e(!empty($featured_img_url) ? $featured_img_url : (get_template_directory_uri() . '/assets/images/placeholder-default.png')); ?>"
                                    class="featured-image" alt="featured image" loading="lazy" />
                                </a>
                            </div>
                            <div class="post-content">
                                <a href="<?php echo esc_url(get_the_permalink($post_id)); ?>">
                                    <h2 class="post-title">
                                        <?php esc_html_e($title); ?>
                                    </h2>
                                </a>
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
                            'prev_text' => sprintf('', __('Newer Posts', 'genplus-media')),
                            'next_text' => sprintf('', __('Older Posts', 'genplus-media')),
                            'mid_size' => 2,
                        )
                    );
                    ?>
                    <div></div>
                </div>
            </div>
        </div>
    <?php }
}