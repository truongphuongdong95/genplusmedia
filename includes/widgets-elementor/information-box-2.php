<?php
class Elementor_Information_Box_2_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_information_box_2_widget';
    }

    public function get_title()
    {
        return esc_html__('Info Box 2 Widget', 'genplus-media');
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
        return ['information', 'box'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return ['widget-style-information-box'];
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
            'direction',
            [
                'label' => esc_html__('Direction', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Left', 'genplus-media'),
                'label_off' => esc_html__('Right', 'genplus-media'),
                'return_value' => 'left',
                'default' => '',
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
            'info_box_image_title',
            [
                'label' => esc_html__('Image Title', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'genplus-media'),
            ]
        );

        $this->add_control(
            'info_box_image_description',
            [
                'label' => esc_html__('Image Description', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the ', 'genplus-media'),
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
                        'name' => 'list_title',
                        'label' => esc_html__('Title', 'genplus-media'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'label_block' => true,
                    ],
                ],
                'default' => [
                    [
                        'list_title' => esc_html__('Lorem Ipsum is simply dummy text #1', 'genplus-media'),
                    ],
                    [
                        'list_title' => esc_html__('Lorem Ipsum is simply dummy text #2', 'genplus-media'),
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_facebook_text',
            [
                'label' => esc_html__('Button Facebook Text', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('GenPlus trên Facebook', 'genplus-media'),
            ]
        );

        $this->add_control(
            'button_facebook_link',
            [
                'label' => esc_html__('Facebook Link', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_tiktok_text',
            [
                'label' => esc_html__('Button Tiktok Text', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('GenPlus trên Tiktok', 'genplus-media'),
            ]
        );

        $this->add_control(
            'button_tiktok_link',
            [
                'label' => esc_html__('Tiktok Link', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="info-box-2-container">
            <div class="info-box-2-wrapper <?php echo $settings['direction']; ?>">
                <div class="info-box-2-image">
                    <img src="<?php echo !empty($settings['info_box_image']['url']) ? $settings['info_box_image']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                        alt="placeholder" loading="lazy">
                    <div class="image-content">
                        <h2 class="image-title"><?php esc_html_e($settings['info_box_image_title']); ?></h2>
                        <p class="image-description"><?php esc_html_e($settings['info_box_image_description']); ?></p>
                    </div>
                </div>
                <div class="info-box-2-content">
                    <div class="wrapper">
                        <h2 class="info-box-2-title"><?php esc_html_e($settings['title']); ?></h2>
                        <ul class="list-info"
                            style="--list-item-icon:url('<?php echo get_template_directory_uri() . '/assets/icon/list-item-icon.svg' ?>')">
                            <?php if (is_array($settings['info_list']) && count($settings['info_list']) > 0): ?>
                                <?php foreach ($settings['info_list'] as $key => $value): ?>
                                    <li class="info-item"><span class="info-title"><?php esc_html_e($value['list_title']); ?></span></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="socials">
                            <a href="<?php esc_attr_e($settings['button_facebook_link']['url']); ?>" class="btn-facebook">
                                <img class="icon-fb" src="<?php echo (get_template_directory_uri() . '/assets/icon/fb-white.svg'); ?>"
                                alt="facebook icon" loading="lazy"> 
                                <?php esc_html_e($settings['button_facebook_text']); ?>
                            </a>
                            <a href="<?php esc_attr_e($settings['button_tiktok_link']['url']); ?>" class="btn-tiktok">
                                <img class="icon-tiktok" src="<?php echo (get_template_directory_uri() . '/assets/icon/tiktok-white.svg'); ?>"
                                alt="tiktok icon" loading="lazy"> 
                                <?php esc_html_e($settings['button_tiktok_text']); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}