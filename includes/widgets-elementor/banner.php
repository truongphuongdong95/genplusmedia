<?php
class Elementor_Banner_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_banner_widget';
    }

    public function get_title()
    {
        return esc_html__('Banner Widget', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-banner';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['banner'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return ['widget-style-banner'];
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
            'title_secondary',
            [
                'label' => esc_html__('Title Secondary', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('GenPlus', 'genplus-media'),
            ]
        );

        $this->add_control(
            'title_primary',
            [
                'label' => esc_html__('Title Primary', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Media', 'genplus-media'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Cam kết & Chủ động', 'genplus-media'),
            ]
        );


        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'genplus-media'),
            ]
        );

        $this->add_control(
            'url_btn_more',
            [
                'label' => esc_html__('URL', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'banner_image',
            [
                'label' => esc_html__('Choose Image', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="banner-container">
            <img class="banner-overlay"
                src="<?php echo get_template_directory_uri() . '/assets/images/banner-overlay-min.png'; ?>" alt="banner overlay" loading="lazy">
            <div class="banner-wrapper">
                <div class="banner-content">
                    <h2 class="banner-title"><?php esc_html_e($settings['title_secondary']); ?> <span
                            class="primary-text"><?php esc_html_e($settings['title_primary']); ?></span></h2>
                    <h3 class="banner-sub-title"><?php esc_html_e($settings['sub_title']); ?></h3>
                    <p class="banner-description">
                        <?php esc_html_e($settings['description']); ?>
                    </p>
                    <a class="btn-more" href="<?php esc_html_e($settings['url_btn_more']['url']); ?>">
                        Xem thêm
                    </a>
                </div>
                <div class="banner-image">
                    <img src="<?php echo !empty($settings['banner_image']['url']) ? $settings['banner_image']['url'] : (get_template_directory_uri() . '/assets/images/banner-img-min.jpg'); ?>"
                        alt="image" loading="lazy">
                </div>
            </div>
        </div>
        <?php
    }
}