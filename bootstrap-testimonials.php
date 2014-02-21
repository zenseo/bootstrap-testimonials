<?php

/**
 * Plugin Name: Bootstrap Testimonials
 * Plugin URI: http://lsdev.biz
 * Description: Testimonials plugin for themes using the BootStrap Framework.
 * Author: Iain Coughtrie
 * Version: 0.8
 * Author URI: http://lsdev.biz
 *
 * @package WordPress
 * @subpackage Bootstrap_Testimonials
 * @author Iain
 * @since 0.1
 */

// Post Type and Custom Fields
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-testimonials-admin.php';

// Shortcode and Template Tag
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-testimonials.php';

// Widget
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-testimonials-widget.php';