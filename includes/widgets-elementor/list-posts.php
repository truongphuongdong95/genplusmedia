<?php
class Elementor_List_Posts_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_list_posts_widget';
    }

    public function get_title()
    {
        return esc_html__('List Posts Widget', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['list', 'post'];
    }

    public function get_script_depends()
    {
        return ['widget-list-posts-script'];
    }

    public function get_style_depends()
    {
        return ['widget-style-list-posts'];
    }

    protected function register_controls()
    {

        // Content Tab Start

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Settings', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider',
            [
                'label' => esc_html__('Enable Slider', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('on', 'textdomain'),
                'label_off' => esc_html__('off', 'textdomain'),
                'return_value' => 'slick',
                'default' => '',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Bài viết nổi bật', 'genplus-media'),
            ]
        );

        $this->add_control(
			'number_posts',
			[
				'label' => esc_html__( 'Number posts', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 10,
			]
		);

        $this->end_controls_section();

        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $args = array(
            'post_type' => 'post',
            'orderby' => 'ID',
            'post_status' => 'publish',
            'order' => 'DESC',
            'post_limits' => $settings['number_posts'],
            'posts_per_page' => $settings['number_posts'] // this will retrive all the post that is published 
        );
        $result = new WP_Query($args);
        ?>
        <div class="list-posts-container">
            <h2 class="title"><?php esc_html_e($settings['title']); ?></h2>
            <div class="list-posts-wrapper">
                <div class="list-posts <?php echo $settings['slider']; ?>">
                    <?php if ($result->have_posts()): ?>
                        <?php while ($result->have_posts()):
                            $result->the_post();
                            $post = $result->post; // WP_Post object
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
                                        <span class="date"><?php esc_html_e(date('d/m/Y H:m', strtotime($post_date))); ?> By</span>
                                        <a href="<?php echo get_author_posts_url($author_id); ?>" class="author-name"><?php esc_html_e($author_name); ?></a>
                                    </div>
                                    <a href="<?php esc_attr_e(get_the_permalink($post_id)); ?>">
                                        <h2 class="post-title"><?php esc_html_e($title); ?>
                                        </h2>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <?php
    }
}