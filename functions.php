<?php

if (!defined('AJAX_URL')) {
    $ajax_url = admin_url('admin-ajax.php');

    define('AJAX_URL', $ajax_url);
}

function theme_support()
{
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Enable support for Post Thumbnails on posts and pages.
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
    // third-party
    wp_enqueue_script('plupload');
    // wp_enqueue_script('jquery-3rd', get_template_directory_uri() . '/assets/js/jquery-3.7.1.min.js', array(), $theme_version, true);
    wp_enqueue_script('jquery-validate', get_template_directory_uri() . '/assets/js/jquery.validate.min.js', array('jquery'), null, true);
    $save_candidate_nonce = wp_create_nonce('save_candidate_nonce');
    $cv_upload_nonce = wp_create_nonce('allow_upload_nonce');
    $ajax_upload_file_attachment_url = add_query_arg('action', 'file_attachment_upload', AJAX_URL);
    $ajax_upload_file_attachment_url = add_query_arg('nonce', $cv_upload_nonce, $ajax_upload_file_attachment_url);
    $variables = array(
        'theme_url' => get_template_directory_uri(),
        'ajax_url' => AJAX_URL,
        'ajax_url_upload_file' => $ajax_upload_file_attachment_url,
        'upload_nonce' => $cv_upload_nonce,
        'save_candidate_nonce' => $save_candidate_nonce,
        'file_type_title' => esc_html__('Valid file formats', 'genplus-media'),
        'attachment_max_file_size' => '1200kb',
        'attachment_file_type' => 'pdf,png,jpg,jpeg',

    );
    wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/main.js', array('jquery', 'plupload'), $theme_version, true);
    wp_script_add_data('main-script', 'strategy', 'defer');
    wp_localize_script('main-script', 'variables', $variables);
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

function create_custom_post_type()
{
    register_post_type(
        'candidate', // Register post type name
        array(
            'labels' => array(
                'name' => esc_html('Candidate', 'genplus-media'),
                'singular_name' => esc_html__('Candidate', 'genplus-media'),
                'add_new' => esc_html__('Add New Candidate', 'genplus-media'),
                'add_new_item' => esc_html__('Add New Candidate', 'genplus-media'),
                'edit_item' => esc_html__('Edit Candidate', 'genplus-media'),
                'new_item' => esc_html__('New Candidate', 'genplus-media'),
                'view_item' => esc_html__('View Candidate', 'genplus-media'),
                'search_items' => esc_html__('Search Candidate', 'genplus-media'),
                'not_found' => esc_html__('No candidate found', 'genplus-media'),
                'not_found_in_trash' => esc_html__('No candidate found in Trash', 'genplus-media'),
                'parent_item_colon' => '',
                'menu_name' => esc_html__('Candidate', 'genplus-media')
            ),
            'capabilities' => array(
                'create_posts' => false,
            ),
            'map_meta_cap' => true, // Important to set this to true
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields')
        )
    );
}
add_action('init', 'create_custom_post_type');

function create_custom_taxonomy()
{
    register_taxonomy(
        'candidate_position',  // Taxonomy name
        'candidate',          // Post type name
        array(
            'label' => esc_html__('Candidate Position', 'genplus-media'),
            'rewrite' => array('slug' => 'candidate-position'),
        )
    );
}
add_action('init', 'create_custom_taxonomy');

function file_attachment_upload_ajax()
{
    $nonce = isset($_REQUEST['nonce']) ? wp_unslash($_REQUEST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'allow_upload_nonce')) {
        $response = array('success' => false, 'reason' => esc_html__('Check nonce failed!', 'genplus-media'));
        echo json_encode($response);
        wp_die();
    }

    $submitted_file = $_FILES['file_attachments_name'];
    $file_attachment = wp_handle_upload($submitted_file, array('test_form' => false));
    if (isset($file_attachment['file'])) {
        $file_name = basename($submitted_file['name']);
        $file_type = wp_check_filetype($file_attachment['file']);

        $attachment_details = array(
            'guid' => $file_attachment['url'],
            'post_mime_type' => $file_type['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', basename($file_name)),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment_details, $file_attachment['file']);
        $attach_data = wp_generate_attachment_metadata($attach_id, $file_attachment['file']);
        wp_update_attachment_metadata($attach_id, $attach_data);
        $attach_url = wp_get_attachment_url($attach_id);
        $file_type_name = isset($file_type['ext']) ? $file_type['ext'] : '';
        $thumb_url = get_template_directory_uri() . '/assets/images/attachment/attach-' . $file_type_name . '.png';

        $response = array(
            'success' => true,
            'url' => $attach_url,
            'attachment_id' => $attach_id,
            'thumb_url' => $thumb_url,
            'file_name' => $file_name
        );
        echo json_encode($response);
        wp_die();

    } else {
        $response = array('success' => false, 'reason' => esc_html__('Upload file failed!', 'genplus-media'));
        echo json_encode($response);
        wp_die();
    }
}

add_action('wp_ajax_file_attachment_upload', 'file_attachment_upload_ajax');
add_action('wp_ajax_nopriv_file_attachment_upload', 'file_attachment_upload_ajax');

function save_candidate()
{
    $candidate = array();
    $candidate['post_author'] = 1;
    $candidate['post_type'] = 'candidate';
    $candidate['post_status'] = 'pending';
    if (isset($_POST['full_name'])) {
        $candidate['post_title'] = wp_unslash($_POST['full_name']);
    }

    if (isset($_POST['content'])) {
        $candidate['post_content'] = wp_filter_post_kses($_POST['content']);
    }

    $candidate_id = wp_insert_post($candidate, true);

    if ($candidate_id > 0) {
        if (isset($_POST['email'])) {
            update_post_meta($candidate_id, 'candidate_email', wp_unslash($_POST['email']));
        }

        if (isset($_POST['phone'])) {
            update_post_meta($candidate_id, 'candidate_phone', wp_unslash($_POST['phone']));
        }

        if (isset($_POST['position'])) {
            $position = wp_unslash($_POST['position']);
            wp_set_object_terms($candidate_id, intval($position), 'candidate_position');
        }

        $attachments_file = isset($_POST['attachment_id']) ? wp_unslash($_POST['attachment_id']) : '';
        if (!empty($attachments_file)) {
            update_post_meta($candidate_id, 'candidate_attachments_file', $attachments_file);
        }

        return $candidate_id;
    }

    return null;
}

function handle_save_candidate_ajax()
{
    $response = array(
        'status' => false,
        'message' => esc_html__('Error, try again!', 'genplus-media'),
    );
    header('Content-Type: application/json');

    $nonce = isset($_REQUEST['nonce']) ? wp_unslash($_REQUEST['nonce']) : '';
    if (!wp_verify_nonce($nonce, 'save_candidate_nonce')) {
        $response = array('status' => false, 'message' => esc_html__('Check nonce failed!', 'genplus-media'));
        echo json_encode($response);
        wp_die();
    }

    $candidate_id = save_candidate();
    if ($candidate_id) {
        $response['status'] = true;
        $response['message'] = esc_html__('Save candidate successfully!', 'genplus-media');
    } else {
        $response['status'] = false;
        $response['message'] = esc_html__('Save candidate failed!', 'genplus-media');
    }

    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_handle_save_candidate', 'handle_save_candidate_ajax');
add_action('wp_ajax_nopriv_handle_save_candidate', 'handle_save_candidate_ajax');