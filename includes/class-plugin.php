<?php
namespace ElementorMultiWidgets;

if (!defined('ABSPATH')) {
    exit;
}

final class Plugin {
    
    private static $_instance = null;
    
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }
    
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }
        
        // Load plugin textdomain
        load_plugin_textdomain('elementor-multi-widgets');
        
        // Register widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);
        
        // Register custom category
        add_action('elementor/elements/categories_registered', [$this, 'add_widget_category']);
        
        // Initialize assets manager
        require_once ELEMENTOR_MULTI_WIDGETS_PATH . 'includes/class-assets-manager.php';
        new Assets_Manager();
    }
    
    public function admin_notice_missing_elementor() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-multi-widgets'),
            '<strong>' . esc_html__('Elementor Multi Widgets', 'elementor-multi-widgets') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-multi-widgets') . '</strong>'
        );
        
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
    
    public function register_widgets($widgets_manager) {
        require_once ELEMENTOR_MULTI_WIDGETS_PATH . 'includes/widgets/class-testimonials-widget.php';
        require_once ELEMENTOR_MULTI_WIDGETS_PATH . 'includes/widgets/class-timeline-widget.php';
        require_once ELEMENTOR_MULTI_WIDGETS_PATH . 'includes/widgets/class-cards-widget.php';
        
        $widgets_manager->register(new Widgets\Testimonials_Widget());
        $widgets_manager->register(new Widgets\Timeline_Widget());
        $widgets_manager->register(new Widgets\Cards_Widget());
    }
    
    public function add_widget_category($elements_manager) {
        $elements_manager->add_category(
            'elementor-multi-widgets',
            [
                'title' => esc_html__('Multi Widgets', 'elementor-multi-widgets'),
                'icon' => 'eicon-apps',
            ]
        );
    }
}