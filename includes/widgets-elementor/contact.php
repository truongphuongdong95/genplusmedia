<?php
class Elementor_Contact_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'elementor_contact_widget';
    }

    public function get_title()
    {
        return esc_html__('Contact Widget', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-site-identity';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['contact'];
    }

    public function get_script_depends()
    {
        return [];
    }

    public function get_style_depends()
    {
        return ['widget-style-contact'];
    }

    protected function register_controls()
    {

        // Content Tab Start

        $this->start_controls_section(
            'section_left',
            [
                'label' => esc_html__('Left', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_left',
            [
                'label' => esc_html__('Heading', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Thông tin liên hệ', 'genplus-media'),
            ]
        );

        $this->add_control(
            'fb_link',
            [
                'label' => esc_html__('Facebook Link', 'genplus-media'),
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
            'tiktok_link',
            [
                'label' => esc_html__('Tiktok Link', 'genplus-media'),
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
            'location_link',
            [
                'label' => esc_html__('Location Link', 'genplus-media'),
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
            'mail_address',
            [
                'label' => esc_html__('Mail Address', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('mail@gmail.com', 'genplus-media'),
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Phone Number', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->add_control(
            'address',
            [
                'label' => esc_html__('Address', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_right',
            [
                'label' => esc_html__('Right', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'heading_right',
            [
                'label' => esc_html__('Heading', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Gửi email cho chúng tôi', 'genplus-media'),
            ]
        );

        $this->add_control(
            'sub_heading_right',
            [
                'label' => esc_html__('Sub Heading', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing', 'genplus-media'),
            ]
        );

        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__('Form Shortcode', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bottom',
            [
                'label' => esc_html__('Bottom', 'genplus-media'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'map_frame',
            [
                'label' => esc_html__('Map Frame', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('', 'genplus-media')
            ]
        );

        $this->end_controls_section();

        // Content Tab End
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="contact-container">
            <div class="contact-wrapper">
                <div class="left">
                    <h2 class="heading"><?php esc_html_e($settings['heading_left']); ?></h2>
                    <ul class="socials">
                        <li class="social-item">
                            <a href="<?php esc_attr_e($settings['fb_link']['url']); ?>" target="_blank">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/fb-white.svg'; ?>"
                                    alt="fb icon" class="social-icon" />
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="<?php esc_attr_e($settings['tiktok_link']['url']); ?>" target="_blank">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/tiktok-white.svg'; ?>"
                                    alt="tiktok icon" class="social-icon" />
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="mailto:<?php esc_attr_e($settings['mail_address']); ?>">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/mail-white.svg'; ?>"
                                    alt="mail icon" class="social-icon" />
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="<?php esc_attr_e($settings['location_link']['url']); ?>" target="_blank">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/map.svg'; ?>" alt="map icon"
                                    class="social-icon" />
                            </a>
                        </li>
                        <li class="social-item">
                            <a href="tel:<?php esc_attr_e($settings['phone_number']); ?>">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/phone.svg'; ?>"
                                    alt="phone icon" class="social-icon" />
                            </a>
                        </li>
                    </ul>
                    <div class="list-information">
                        <div class="phone">
                            <div class="icon-wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/mobi-secondary.svg'; ?>"
                                    alt="phone icon" class="social-icon" />
                            </div>
                            <div class="info">
                                <label>Số điện thoại</label>
                                <p><?php esc_html_e($settings['phone_number']); ?></p>
                            </div>
                        </div>
                        <div class="email">
                            <div class="icon-wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/mail-secondary.svg'; ?>"
                                    alt="email icon" class="social-icon" />
                            </div>
                            <div class="info">
                                <label>Email</label>
                                <p><?php esc_html_e($settings['mail_address']); ?></p>
                            </div>
                        </div>
                        <div class="location">
                            <div class="icon-wrapper">
                                <img src="<?php echo get_template_directory_uri() . '/assets/icon/map-secondary.svg'; ?>"
                                    alt="location icon" class="social-icon" />
                            </div>
                            <div class="info">
                                <label>Địa chỉ</label>
                                <p><?php esc_html_e($settings['address']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <h2 class="heading"><?php esc_html_e($settings['heading_right']); ?></h2>
                    <h3 class="sub-heading"><?php esc_html_e($settings['sub_heading_right']); ?></h3>
                    <?php echo $settings['form_shortcode']; ?>
                </div>
            </div>
            <div class="map-wrapper">
                <?php echo $settings['map_frame']; ?>
            </div>
        </div>
        <?php
    }
}