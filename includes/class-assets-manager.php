<?php
namespace ElementorMultiWidgets;

if (!defined('ABSPATH')) {
    exit;
}

class Assets_Manager {
    
    public function __construct() {
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'enqueue_frontend_scripts']);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);
    }
    
    public function enqueue_frontend_styles() {
        wp_enqueue_style(
            'font-awesome',
            ELEMENTOR_MULTI_WIDGETS_ASSETS_URL . 'css/font-awesome.min.css',
            [],
            '5.15.3'
        );
        
        wp_enqueue_style(
            'elementor-multi-widgets-frontend',
            ELEMENTOR_MULTI_WIDGETS_ASSETS_URL . 'css/frontend.css',
            ['font-awesome'],
            ELEMENTOR_MULTI_WIDGETS_VERSION
        );
    }
    
    public function enqueue_frontend_scripts() {
        wp_enqueue_script(
            'elementor-multi-widgets-frontend',
            ELEMENTOR_MULTI_WIDGETS_ASSETS_URL . 'js/frontend.js',
            ['jquery'],
            ELEMENTOR_MULTI_WIDGETS_VERSION,
            true
        );
    }
    
    public function enqueue_editor_styles() {
        wp_enqueue_style(
            'elementor-multi-widgets-editor',
            ELEMENTOR_MULTI_WIDGETS_ASSETS_URL . 'css/backend.css',
            [],
            ELEMENTOR_MULTI_WIDGETS_VERSION
        );
    }
}