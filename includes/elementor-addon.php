<?php

function register_widget_elementor($widgets_manager)
{

	require_once (__DIR__ . '/widgets-elementor/banner.php');
	require_once (__DIR__ . '/widgets-elementor/service.php');
	require_once (__DIR__ . '/widgets-elementor/information-box.php');
	require_once (__DIR__ . '/widgets-elementor/list-posts.php');
	require_once (__DIR__ . '/widgets-elementor/about-us-information.php');

	$widgets_manager->register(new \Elementor_Banner_Widget());
	$widgets_manager->register(new \Elementor_Service_Widget());
	$widgets_manager->register(new \Elementor_Information_Box_Widget());
	$widgets_manager->register(new \Elementor_List_Posts_Widget());
	$widgets_manager->register(new \Elementor_About_Us_Information_Widget());
}
add_action('elementor/widgets/register', 'register_widget_elementor');

/**
 * Register scripts and styles for Elementor test widgets.
 */
function elementor_widgets_dependencies()
{
	/* 3rd */
	wp_register_script('slick-script', get_template_directory_uri() . '/includes/assets/3rd/slick/slick.min.js',  [ 'jquery' ], false, true);
	wp_enqueue_script( 'slick-script' );
	wp_register_style('slick-style', get_template_directory_uri() . '/includes/assets/3rd/slick/slick.css');
	wp_enqueue_style('slick-style');
	wp_register_style('slick-theme-style', get_template_directory_uri() . '/includes/assets/3rd/slick/slick-theme.css');
	wp_enqueue_style('slick-theme-style');
	/* Scripts */
	wp_enqueue_script( 'jquery' );
	wp_register_script( 'widget-list-posts-script',  get_template_directory_uri() . '/includes/assets/js/widget-list-posts-script.js', [ 'jquery' ], false, true);

	/* Styles */
	wp_register_style('widget-style-banner', get_template_directory_uri() . '/includes/assets/css/banner.css');
	wp_register_style('widget-style-service', get_template_directory_uri() . '/includes/assets/css/service.css');
	wp_register_style('widget-style-information-box', get_template_directory_uri() . '/includes/assets/css/information-box.css');
	wp_register_style('widget-style-list-posts', get_template_directory_uri() . '/includes/assets/css/list-posts.css');
	wp_register_style('widget-style-about-us-information', get_template_directory_uri() . '/includes/assets/css/about-us-information.css');
}

// add_action('wp_enqueue_scripts', 'elementor_widgets_dependencies');
add_action('elementor/frontend/before_enqueue_scripts', 'elementor_widgets_dependencies', 100);