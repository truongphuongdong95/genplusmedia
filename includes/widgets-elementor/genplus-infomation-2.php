<?php
class Elementor_GenPlus_Information_2_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_genplus_information_widget_2';
    }

    public function get_title()
    {
        return esc_html__('GenPlus Info Widget 2', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-info';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['genplus', 'info'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return ['widget-style-genplus-info'];
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
                'label' => esc_html__('Heading', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'genplus-media'),
            ]
        );

        $this->add_control(
            'info_box_image',
            [
                'label' => esc_html__('Choose Image', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.', 'genplus-media'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Text button', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('GenPlus trên Facebook', 'genplus-media'),
            ]
        );

        $this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link Button', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
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
        <div class="genplus-info-2-container"
            style="--bg-genplus-info-min:url('<?php echo get_template_directory_uri() . '/assets/images/bg-genplus-info-min.png' ?>')">
            <div class="genplus-info-2-wrapper">
                <div class="genplus-info-2-left">
                    <div class="wrapper-content">
                        <h2 class="genplus-info-2-title"><?php esc_html_e($settings['title']); ?></h2>
                        <p class="description"><?php esc_html_e($settings['description']); ?></p>
                        <a href="<?php esc_html_e($settings['button_link']['url']); ?>" class="btn-facebook">
                            <img class="icon-fb" src="<?php echo (get_template_directory_uri() . '/assets/icon/fb-white.svg'); ?>" alt="icon" loading="lazy"> <span><?php esc_html_e($settings['button_text']); ?></span>
                        </a>
                    </div>
                </div>
                <div class="genplus-info-2-right">
                    <div class="wrapper-image">
                        <img src="<?php echo !empty($settings['info_box_image']['url']) ? $settings['info_box_image']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                            alt="image" loading="lazy">
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}