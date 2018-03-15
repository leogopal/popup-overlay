<?php
/**
 * The main plugin file.
 *
 * This file loads the main plugin class and gets things running.
 *
 * @since 0.0.1
 *
 * @package Popup_Overlay
 */

/**
 * Plugin Name: TU Popup Overlay
 * Description: A simple popup overlay for TU.
 * Author:      Digitlab
 * Author URI:  http://digitlab.co.za
 * Version:     0.0.2
 * Text Domain: sera
 * Domain Path: /languages/
 */

if ( ! defined( 'WPINC' ) ) { die(); }

/**
 * The main class definition.
 */
require( plugin_dir_path( __FILE__ ) . 'includes/class-popup-overlay.php' );


// Get the plugin running.
add_action( 'plugins_loaded', array( 'Popup_Overlay', 'get_instance' ) );
