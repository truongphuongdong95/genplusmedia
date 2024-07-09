<?php
class Elementor_Service_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_service_widget';
    }

    public function get_title()
    {
        return esc_html__('Service Widget', 'genplus-media');
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
        return ['service'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return ['widget-style-service'];
    }

    protected function register_controls()
    {

        // Content Tab Start
        $this->start_controls_section(
            'settings',
            [
                'label' => esc_html__('Settings', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title ', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Dịch vụ', 'genplus-media'),
            ]
        );
        $this->end_controls_section();

        //Item 1
        $this->start_controls_section(
            'section_1',
            [
                'label' => esc_html__('Item 1', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_1',
            [
                'label' => esc_html__('Title ', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Maketing online', 'genplus-media'),
            ]
        );


        $this->add_control(
            'description_1',
            [
                'label' => esc_html__('Description', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Lorem Ipsum is simply dummy text on of the printing and typesetting of industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'genplus-media'),
            ]
        );

        $this->end_controls_section();

        //Item 2
        $this->start_controls_section(
            'section_2',
            [
                'label' => esc_html__('Item 2', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_2',
            [
                'label' => esc_html__('Title ', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Make Money Online (MMO)', 'genplus-media'),
            ]
        );


        $this->add_control(
            'description_2',
            [
                'label' => esc_html__('Description', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Lorem Ipsum is simply dummy text on of the printing and typesetting of industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'genplus-media'),
            ]
        );

        $this->end_controls_section();

        //Item 3
        $this->start_controls_section(
            'section_3',
            [
                'label' => esc_html__('Item 3', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title_3',
            [
                'label' => esc_html__('Title ', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Báo chí truyền thông', 'genplus-media'),
            ]
        );


        $this->add_control(
            'description_3',
            [
                'label' => esc_html__('Description', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__("Lorem Ipsum is simply dummy text on of the printing and typesetting of industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s", 'genplus-media'),
            ]
        );

        $this->end_controls_section();
        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="service-container">
            <div class="service-shape-wrapper">
                <span class="circle circle-border"></span>
                <span class="circle circle-border"></span>
                <span class="circle circle-border"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <img src="<?php echo get_template_directory_uri() . '/assets/icon/plus-overlay.svg'; ?>" class="circle plus" />
                <img src="<?php echo get_template_directory_uri() . '/assets/icon/plus-overlay.svg'; ?>" class="circle plus" />
                <img src="<?php echo get_template_directory_uri() . '/assets/icon/plus-overlay.svg'; ?>" class="circle plus" />
            </div>
            <div class="service-wrapper">
                <div class="title"><?php esc_html_e($settings['title']); ?></div>
                <div class="list-service">
                    <div class="service-item">
                        <div class="icon-wrapper">
                            <img src="<?php echo get_template_directory_uri() . '/assets/icon/marketing-online.svg'; ?>"
                                class="icon" />
                        </div>
                        <div class="service-info">
                            <h3 class="service-name"><?php esc_html_e($settings['title_1']); ?></h3>
                            <p class="service-description"><?php esc_html_e($settings['description_1']); ?></p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="icon-wrapper">
                            <img src="<?php echo get_template_directory_uri() . '/assets/icon/mmo.svg'; ?>" class="icon" />
                        </div>
                        <div class="service-info">
                            <h3 class="service-name"><?php esc_html_e($settings['title_2']); ?></h3>
                            <p class="service-description"><?php esc_html_e($settings['description_2']); ?></p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="icon-wrapper">
                            <img src="<?php echo get_template_directory_uri() . '/assets/icon/media-socials.svg'; ?>"
                                class="icon" />
                        </div>
                        <div class="service-info">
                            <h3 class="service-name"><?php esc_html_e($settings['title_3']); ?></h3>
                            <p class="service-description"><?php esc_html_e($settings['description_3']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}