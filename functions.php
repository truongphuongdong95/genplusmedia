<?php
function theme_support()
{

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // Set post thumbnail size.
    set_post_thumbnail_size(1200, 9999);

    // Add custom image size used in Cover Template.
    add_image_size('image-fullscreen', 1980, 9999);

    // Custom logo.
    $logo_width = 120;
    $logo_height = 90;

    // If the retina setting is active, double the recommended width and height.
    if (get_theme_mod('retina_logo', false)) {
        $logo_width = floor($logo_width * 2);
        $logo_height = floor($logo_height * 2);
    }

    add_theme_support(
        'custom-logo',
        array(
            'height' => $logo_height,
            'width' => $logo_width,
            'flex-height' => true,
            'flex-width' => true,
        )
    );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
            'navigation-widgets',
        )
    );

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for responsive embeds.
    add_theme_support('responsive-embeds');
}

add_action('after_setup_theme', 'theme_support');

/**
 * REQUIRED FILES
 * Include required files.
 */
require get_template_directory() . '/includes/helper.php';
require get_template_directory() . '/includes/elementor-addon.php';
/**
 * Register and Enqueue Styles.
 */
function register_styles()
{

    $theme_version = wp_get_theme()->get('Version');

    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', array(), $theme_version);
}

add_action('wp_enqueue_scripts', 'register_styles');

/**
 * Register and Enqueue Scripts.
 */
function register_scripts()
{

    $theme_version = wp_get_theme()->get('Version');

    if ((!is_admin()) && is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    // wp_enqueue_script('jquery-3rd', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), $theme_version, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $theme_version, true);
    wp_script_add_data('main-js', 'strategy', 'defer');
}

add_action('wp_enqueue_scripts', 'register_scripts');

function menus_registration()
{

    $locations = array(
        'primary' => __('Desktop Horizontal Menu', 'genplus-media'),
        'expanded' => __('Desktop Expanded Menu', 'genplus-media'),
        'mobile' => __('Mobile Menu', 'genplus-media'),
        'footer-1' => __('Footer Menu 1', 'genplus-media'),
        'footer-2' => __('Footer Menu 2', 'genplus-media'),
        'social' => __('Social Menu', 'genplus-media'),
    );

    register_nav_menus($locations);
}

add_action('init', 'menus_registration');

if (!function_exists('wp_body_open')) {
    function wp_body_open()
    {
        /** This action is documented in wp-includes/general-template.php */
        do_action('wp_body_open');
    }
}

/**
 * Register widget areas.
 */
function sidebar_registration()
{

    // Arguments used in all register_sidebar() calls.
    $shared_args = array(
        'before_title' => '<h2 class="widget-title subheading heading-size-3">',
        'after_title' => '</h2>',
        'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
        'after_widget' => '</div></div>',
    );

    // Footer #1.
    register_sidebar(
        array_merge(
            $shared_args,
            array(
                'name' => __('Footer #1', 'genplus-media'),
                'id' => 'sidebar-1',
                'description' => __('Widgets in this area will be displayed in the first column in the footer.', 'genplus-media'),
            )
        )
    );
}

add_action('widgets_init', 'sidebar_registration');