<?php

/**
 * Plugin Name: Bootstrap Testimonials
 * Plugin URI: http://lsdev.biz
 * Description: Testimonials plugin for themes using the BootStrap Framework.
 * Author: Iain Coughtrie
 * Version: 1.02
 * Author URI: http://lsdev.biz
 */

// Post Type and Custom Fields
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-testimonials-admin.php';

// Shortcode and Template Tag
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-testimonials.php';

// Widget
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-testimonials-widget.php';