<?php
/**
 * Plugin Name: Elementor LAWCLERK Widgets
 * Description: Custom widgets for LAWCLERK.
 * Version:     1.0.0
 * Author:      MindK
 * Author URI:  https://www.mindk.com/
 */

function register_lawclerk_widget( $widgets_manager ) {
	include_once __DIR__ . '/widgets/slider-attorneys.php';
	include_once __DIR__ . '/widgets/slidedown-banner.php';

	$widgets_manager->register( new \Elementor_Slider_Attorneys() );
	$widgets_manager->register( new \Elementor_Slidedown_Banner() );
}
add_action( 'elementor/widgets/register', 'register_lawclerk_widget' );
