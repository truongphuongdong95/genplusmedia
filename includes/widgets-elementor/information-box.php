<?php
class Elementor_Information_Box_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_information_box_widget';
    }

    public function get_title()
    {
        return esc_html__('Info Box Widget', 'genplus-media');
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
				'label' => esc_html__( 'Direction', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Left', 'textdomain' ),
				'label_off' => esc_html__( 'Right', 'textdomain' ),
				'return_value' => 'left',
				'default' => '',
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
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('GenPlus Media', 'genplus-media'),
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
				'label' => esc_html__( 'Info List', 'genplus-media' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'list_title',
						'label' => esc_html__( 'Title', 'genplus-media' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					],
				],
				'default' => [
					[
						'list_title' => esc_html__( 'Lorem Ipsum is simply dummy text #1', 'genplus-media' ),
					],
					[
						'list_title' => esc_html__( 'Lorem Ipsum is simply dummy text #2', 'genplus-media' ),
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
        <div class="info-box-container">
            <div class="info-box-wrapper <?php echo $settings['direction']; ?>">
                <div class="info-box-content">
                    <div class="wrapper">
                        <h3 class="info-box-sub-title"><?php esc_html_e($settings['sub_title']); ?></h3>
                        <h2 class="info-box-title"><?php esc_html_e($settings['title']); ?></h2>
                        <ul class="list-info" style="--list-item-icon:url('<?php echo get_template_directory_uri() . '/assets/icon/list-item-icon.svg' ?>')">
                            <?php if(is_array($settings['info_list']) && count($settings['info_list']) > 0): ?>
                                <?php foreach ($settings['info_list'] as $key => $value) : ?>
                                    <li><?php esc_html_e($value['list_title']); ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="info-box-image">
                    <img src="<?php echo !empty($settings['info_box_image']['url']) ? $settings['info_box_image']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                        alt="placeholder" loading="lazy">
                </div>
            </div>
        </div>
        <?php
    }
}