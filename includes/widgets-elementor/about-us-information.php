<?php
class Elementor_About_Us_Information_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_about_us_information_widget';
    }

    public function get_title()
    {
        return esc_html__('About Us Info Widget', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-alert';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['information', 'box', 'about', 'us'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return ['widget-style-about-us-information'];
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
            'title',
            [
                'label' => esc_html__('Title', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'genplus-media'),
            ]
        );

        $this->add_control(
            'info_box_image',
            [
                'label' => esc_html__('Choose Image', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'info_list',
            [
                'label' => esc_html__('Info List', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'list_icon',
                        'label' => esc_html__('Choose Icon', 'genplus-media'),
                        'type' => \Elementor\Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'list_title',
                        'label' => esc_html__('Title', 'genplus-media'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'list_desc',
                        'label' => esc_html__('Description', 'genplus-media'),
                        'type' => \Elementor\Controls_Manager::TEXTAREA,
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'list_title' => esc_html__('Lorem Ipsum #1', 'genplus-media'),
                        'list_desc' => esc_html__('Lorem Ipsum is simply dummy text #1', 'genplus-media'),
                    ],
                    [
                        'list_title' => esc_html__('Lorem Ipsum #2', 'genplus-media'),
                        'list_desc' => esc_html__('Lorem Ipsum is simply dummy text #2', 'genplus-media'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="about-us-info-container">
            <h2 class="about-us-info-title"><?php esc_html_e($settings['title']); ?></h2>
            <div class="about-us-info-wrapper">
                <div class="about-us-info-image">
                    <img src="<?php echo !empty($settings['info_box_image']['url']) ? $settings['info_box_image']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                        alt="placeholder" loading="lazy">
                </div>
                <div class="about-us-info-content">
                    <ul class="list-info">
                        <?php if (is_array($settings['info_list']) && count($settings['info_list']) > 0): ?>
                            <?php foreach ($settings['info_list'] as $key => $value): ?>
                                <li class="list-item">
                                    <img src="<?php echo !empty($value['list_icon']['url']) ? $value['list_icon']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                                        alt="placeholder" loading="lazy">
                                    <div class="content">
                                        <h3 class="title"><?php esc_html_e($value['list_title']); ?></h3>
                                        <p class="description"><?php esc_html_e($value['list_desc']); ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php
    }
}