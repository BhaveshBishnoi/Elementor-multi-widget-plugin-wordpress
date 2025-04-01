<?php
/**
 * Plugin Name: Elementor Multi Widgets
 * Description: Multiple custom widgets for Elementor including Testimonials, Timeline, and Clickable Cards.
 * Version: 1.0.0
 * Author: Bhavesh Bishnoi
 * Author URI: https://bhaveshbishnoi.com
 * Text Domain: elementor-multi-widgets
 */

if (!defined('ABSPATH')) {
    exit;
}

define('ELEMENTOR_MULTI_WIDGETS_VERSION', '1.0.0');
define('ELEMENTOR_MULTI_WIDGETS_FILE', __FILE__);
define('ELEMENTOR_MULTI_WIDGETS_PATH', plugin_dir_path(ELEMENTOR_MULTI_WIDGETS_FILE));
define('ELEMENTOR_MULTI_WIDGETS_URL', plugins_url('/', ELEMENTOR_MULTI_WIDGETS_FILE));
define('ELEMENTOR_MULTI_WIDGETS_ASSETS_URL', ELEMENTOR_MULTI_WIDGETS_URL . 'assets/');

require_once ELEMENTOR_MULTI_WIDGETS_PATH . 'includes/class-plugin.php';

\ElementorMultiWidgets\Plugin::instance();