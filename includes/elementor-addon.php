<?php

function register_widget_elementor( $widgets_manager ) {

	require_once( __DIR__ . '/widgets-elementor/banner.php' );
	require_once( __DIR__ . '/widgets-elementor/service.php' );


	$widgets_manager->register( new \Elementor_Banner_Widget() );
	$widgets_manager->register( new \Elementor_Service_Widget() );
}
add_action( 'elementor/widgets/register', 'register_widget_elementor' );

/**
 * Register scripts and styles for Elementor test widgets.
 */
function elementor_widgets_dependencies() {

	/* Scripts */
	// wp_register_script( 'widget-script-1', plugins_url( '/includes/assets/js/widget-script-1.js', __FILE__ ) );

	/* Styles */
	wp_register_style( 'widget-style-banner', get_template_directory_uri() .'/includes/assets/css/banner.css');
	wp_register_style( 'widget-style-service', get_template_directory_uri() .'/includes/assets/css/service.css');

}
add_action( 'wp_enqueue_scripts', 'elementor_widgets_dependencies' );
add_action( 'elementor/editor/before_enqueue_styles', 'elementor_widgets_dependencies' );