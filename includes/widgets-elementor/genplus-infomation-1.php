<?php
class Elementor_GenPlus_Information_1_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_genplus_information_widget_1';
    }

    public function get_title()
    {
        return esc_html__('GenPlus Info Widget 1', 'genplus-media');
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
            'heading',
            [
                'label' => esc_html__('Heading', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Title', 'genplus-media'),
            ]
        );

        $this->add_control(
            'sub_heading',
            [
                'label' => esc_html__('Sub Heading', 'genplus-media'),
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
            'info_box_image_1',
            [
                'label' => esc_html__('Choose Image 1', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'info_box_image_2',
            [
                'label' => esc_html__('Choose Image 2', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::MEDIA,
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

        $this->end_controls_section();

        // Content Tab End

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="genplus-info-1-container"
            style="--bg-genplus-info-min:url('<?php echo get_template_directory_uri() . '/assets/images/bg-genplus-info-min.png' ?>')">
            <span class="circle circle-border"></span>
            <span class="circle circle-border"></span>
            <div class="genplus-info-1-wrapper">
                <div class="genplus-info-1-left">
                    <div class="wrapper-title">
                        <div class="icon-title">
                            <img src="<?php echo (get_template_directory_uri() . '/assets/icon/groups.svg'); ?>" alt="icon"
                                loading="lazy">
                        </div>
                        <h2 class="genplus-info-1-heading"><?php esc_html_e($settings['heading']); ?></h2>
                        <p class="genplus-info-1-sub-heading"><?php esc_html_e($settings['sub_heading']); ?></p>
                    </div>
                    <div class="wrapper-image">
                        <img src="<?php echo !empty($settings['info_box_image_1']['url']) ? $settings['info_box_image_1']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                            alt="image" loading="lazy">
                        <img src="<?php echo !empty($settings['info_box_image_2']['url']) ? $settings['info_box_image_2']['url'] : (get_template_directory_uri() . '/assets/images/placeholder-default.png'); ?>"
                            alt="image" loading="lazy">
                    </div>
                </div>
                <div class="genplus-info-1-right">
                    <div class="wrapper">
                        <h3 class="genplus-info-1-sub-title"><?php esc_html_e($settings['sub_title']); ?></h3>
                        <p class="description"><?php esc_html_e($settings['description']); ?></p>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
}