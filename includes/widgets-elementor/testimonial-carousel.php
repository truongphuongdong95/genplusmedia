<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Testimonial_Carousel_Widget extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'testimonial_carousel_widget';
    }

    public function get_title()
    {
        return esc_html__('Testimonial Carousel', 'genplus-media');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['testimonial', 'carousel'];
    }

    public function get_script_depends()
    {
        return ['widget-script-testimonial-carousel'];
    }

    public function get_style_depends()
    {
        return ['widget-style-testimonial-carousel'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => esc_html__('Testimonial', 'genplus-media'),
            ]
        );

        $this->add_control(
            'total_rating',
            [
                'label' => esc_html__('Total Rating', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 5,
                'step' => 0.1,
                'default' => 0,
            ]
        );

        $this->add_control(
            'number_reviews',
            [
                'label' => esc_html__('Number Reviews', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 999999999,
                'step' => 1,
                'default' => 0,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'testimonial_image',
            [
                'label' => esc_html__('Choose Image', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ],
        );

        $repeater->add_control(
            'testimonial_name',
            [
                'label' => esc_html__('Name', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'ai' => [
                    'active' => false,
                ],
                'default' => esc_html__('John Doe', 'genplus-media'),
            ],
        );

        $repeater->add_control(
            'rating_scale',
            [
                'label' => esc_html__('Rating Scale', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '5' => '0-5',
                    '10' => '0-10',
                ],
                'default' => '5',
            ],
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 10,
                'step' => 0.1,
                'default' => 5,
                'dynamic' => [
                    'active' => true,
                ],
            ],
        );

        $repeater->add_control(
            'star_style',
            [
                'label' => esc_html__('Icon', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'star_fontawesome' => 'Font Awesome',
                    'star_unicode' => 'Unicode',
                ],
                'default' => 'star_fontawesome',
                'render_type' => 'template',
                'prefix_class' => 'elementor--star-style-',
                'separator' => 'before',
            ],
        );

        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Content', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'rows' => '10',
                'default' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting the is are y industry. Lorem Ipsum has been the industry\'s standard dummy text the blu ever since the 1500s, when an is job unknown printer took a galley of the is type and scrambled Lorem Ipsum is the simply dummy text of the printing.', 'genplus-media'),
            ]
        );

        $this->add_control(
            'list_testimonial',
            [
                'label' => esc_html__('Testimonial List', 'genplus-media'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_image' => \Elementor\Utils::get_placeholder_image_src(),
                        'testimonial_name' => esc_html__('Thuong Nguyen', 'genplus-media'),
                        'rating_scale' => esc_html__('5', 'genplus-media'),
                        'rating' => esc_html__('5', 'genplus-media'),
                        'star_style' => esc_html__('star_fontawesome', 'genplus-media'),
                        'testimonial_content' => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting the is are y industry. Lorem Ipsum has been the industry\'s standard dummy text the blu ever since the 1500s, when an is job unknown printer took a galley of the is type and scrambled Lorem Ipsum is the simply dummy text of the printing.', 'genplus-media'),
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_rating($setting)
    {
        $rating_scale = (int) $setting['rating_scale'];
        $rating = (float) $setting['rating'] > $rating_scale ? $rating_scale : $setting['rating'];
        return [$rating, $rating_scale];
    }

    protected function render_stars($icon, $setting)
    {
        $rating_data = $this->get_rating($setting);
        $rating = (float) $rating_data[0];
        $floored_rating = floor($rating);
        $stars_html = '';
        for ($stars = 1.0; $stars <= $rating_data[1]; $stars++) {
            if ($stars <= $floored_rating) {
                $stars_html .= '<i class="elementor-star-full">' . $icon . '</i>';
            } elseif ($floored_rating + 1 === $stars && $rating !== $floored_rating) {
                $stars_html .= '<i class="elementor-star-' . ($rating - $floored_rating) * 10 . '">' . $icon . '</i>';
            } else {
                $stars_html .= '<i class="elementor-star-empty">' . $icon . '</i>';
            }
        }
        return $stars_html;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'testimonial-carousel-wrapper');
        $this->add_render_attribute('meta', 'class', 'testimonial-carousel-meta');
        $this->add_render_attribute('testimonial_content', 'class', 'testimonial-content');
        $this->add_render_attribute('testimonial_name', 'class', 'testimonial-name');
        $this->add_render_attribute('icon_wrapper', [
            'class' => 'elementor-star-rating',
            'title' => 'star rating',
            'itemtype' => 'http://schema.org/Rating',
            'itemscope' => '',
            'itemprop' => 'reviewRating',
        ]);
        ?>
        <div class="testimonial-carousel-container">
            <div class="overall-rating">
                <h2 class="total-rating"><?php echo round($settings['total_rating'], 1); ?></h2>
                <div class="rating-information">
                    <?php
                    $icon = '&#xE934;';
                    $setting = array(
                        'rating' => $settings['total_rating'],
                        'rating_scale' => 5
                    );
                    $textual_rating = $setting['rating'] . '/' . $setting['rating_scale'];
                    $this->add_render_attribute('total_rating_icon_wrapper', [
                        'class' => 'elementor-star-rating',
                        'title' => $textual_rating,
                        'itemtype' => 'http://schema.org/Rating',
                        'itemscope' => '',
                        'itemprop' => 'reviewRating',
                    ]);
                    $stars_element = '<div ' . $this->get_render_attribute_string('total_rating_icon_wrapper') . '>' . $this->render_stars($icon, $setting) . '</div>';
                    echo $stars_element;
                    ?>
                    <p class="number-reviews"><?php esc_html_e('Based on '.$settings['number_reviews'].' Reviews'); ?></p>
                </div>
            </div>
            <div class="list-testimonial slick">
                <?php foreach ($settings['list_testimonial'] as $key => $setting) {
                    $has_content = !empty($setting['testimonial_content']);
                    $has_image = !empty($setting['testimonial_image']['url']);
                    $has_name = !empty($setting['testimonial_name']);

                    if (!$has_content && !$has_image && !$has_name) {
                        return;
                    }

                    $rating_data = $this->get_rating($setting);
                    $textual_rating = $rating_data[0] . '/' . $rating_data[1];

                    if ('star_fontawesome' === $setting['star_style']) {
                        $icon = '&#xE934;';
                    } elseif ('star_unicode' === $setting['star_style']) {
                        $icon = '&#9733;';
                    }

                    $schema_rating = '<span itemprop="ratingValue" class="elementor-screen-only">' . $textual_rating . '</span>';
                    $stars_element = '<div ' . $this->get_render_attribute_string('icon_wrapper') . '>' . $this->render_stars($icon, $setting) . ' ' . $schema_rating . '</div>';
                    ?>
                    <div <?php $this->print_render_attribute_string('wrapper'); ?>>
                        <?php if ($has_image || $has_name): ?>
                            <div <?php $this->print_render_attribute_string('meta'); ?>>
                                <div class="testimonial-carousel-meta-inner">
                                    <?php if ($has_image): ?>
                                        <div class="testimonial-image">
                                            <?php
                                            $image_html = \Elementor\Group_Control_Image_Size::get_attachment_image_html($setting, 'testimonial_image');
                                            echo wp_kses_post($image_html);
                                            ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($has_name): ?>
                                        <div class="testimonial-carousel-details">
                                            <div class="elementor-star-rating__wrapper">
                                                <?php echo $stars_element; ?>
                                            </div>
                                            <?php if ($has_name): ?>
                                                <div <?php $this->print_render_attribute_string('testimonial_name'); ?>>
                                                    <?php echo $setting['testimonial_name']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="testimonial-icon">
                                        <img src="<?php echo (get_template_directory_uri() . '/assets/images/testimonial.png'); ?>"
                                            alt="testimonial icon">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($has_content): ?>
                            <div <?php $this->print_render_attribute_string('testimonial_content'); ?>>
                                <?php echo $setting['testimonial_content']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
    <?php }
}