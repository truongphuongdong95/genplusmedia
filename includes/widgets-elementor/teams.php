<?php
class Elementor_Team_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_team_widget';
    }

    public function get_title()
    {
        return esc_html__('Team Widget', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-person';
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
        return ['widget-style-teams'];
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
            'info_list',
            [
                'label' => esc_html__('Info List', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'list_image',
                        'label' => esc_html__('Choose Image', 'genplus-media'),
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
                        'name' => 'position',
                        'label' => esc_html__('Position', 'genplus-media'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                    [
                        'name' => 'email',
                        'label' => esc_html__('Email', 'genplus-media'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'list_title' => esc_html__('Lorem Ipsum #1', 'genplus-media'),
                        'position' => esc_html__('Manager', 'genplus-media'),
                        'email' => esc_html__('contact@genplusmedia.com', 'genplus-media'),
                    ],
                    [
                        'list_title' => esc_html__('Lorem Ipsum #2', 'genplus-media'),
                        'position' => esc_html__('Manager', 'genplus-media'),
                        'email' => esc_html__('contact@genplusmedia.com', 'genplus-media'),
                    ],
                    [
                        'list_title' => esc_html__('Lorem Ipsum #3', 'genplus-media'),
                        'position' => esc_html__('Manager', 'genplus-media'),
                        'email' => esc_html__('contact@genplusmedia.com', 'genplus-media'),
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
        <div class="teams-container">
            <h2 class="teams-title"><?php esc_html_e($settings['title']); ?></h2>
            <div class="teams-wrapper">
                <ul class="list-info">
                    <?php if (is_array($settings['info_list']) && count($settings['info_list']) > 0): ?>
                        <?php foreach ($settings['info_list'] as $key => $value): ?>
                            <li class="list-item">
                                <img src="<?php echo !empty($value['list_image']['url']) ? $value['list_image']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>" alt="image" loading="lazy">
                                <div class="content">
                                    <h3 class="title"><?php esc_html_e($value['list_title']); ?></h3>
                                    <p class="position"><?php esc_html_e($value['position']); ?></p>
                                    <p class="email"><?php esc_html_e($value['email']); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <?php
    }
}