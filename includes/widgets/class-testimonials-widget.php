<?php
namespace ElementorMultiWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}

class Testimonials_Widget extends Widget_Base {
    
    public function get_name() {
        return 'multi_testimonials';
    }
    
    public function get_title() {
        return esc_html__('Testimonials', 'elementor-multi-widgets');
    }
    
    public function get_icon() {
        return 'eicon-testimonial';
    }
    
    public function get_categories() {
        return ['elementor-multi-widgets'];
    }
    
    protected function register_controls() {
        // Content Tab
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'elementor-multi-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Name', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'position',
            [
                'label' => esc_html__('Position', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('CEO', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'testimonial_content',
            [
                'label' => esc_html__('Content', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'elementor-multi-widgets'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );
        
        $this->add_control(
            'testimonials',
            [
                'label' => esc_html__('Testimonials', 'elementor-multi-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'name' => esc_html__('John Doe', 'elementor-multi-widgets'),
                        'position' => esc_html__('CEO', 'elementor-multi-widgets'),
                        'testimonial_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-multi-widgets'),
                    ],
                    [
                        'name' => esc_html__('Jane Smith', 'elementor-multi-widgets'),
                        'position' => esc_html__('Designer', 'elementor-multi-widgets'),
                        'testimonial_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-multi-widgets'),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );
        
        $this->end_controls_section();
        
        // Style Tab
        $this->style_tab();
    }
    
    private function style_tab() {
        // Container Style
        $this->start_controls_section(
            'container_style',
            [
                'label' => esc_html__('Container', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'container_bg',
            [
                'label' => esc_html__('Background Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .multi-testimonial-item',
            ]
        );
        
        $this->add_control(
            'container_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'selector' => '{{WRAPPER}} .multi-testimonial-item',
            ]
        );
        
        $this->add_control(
            'container_padding',
            [
                'label' => esc_html__('Padding', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Image Style
        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__('Image', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Size', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 80,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .multi-testimonial-image img',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .multi-testimonial-image img',
            ]
        );
        
        $this->add_control(
            'image_spacing',
            [
                'label' => esc_html__('Spacing', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-image' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Content Style
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'name_heading',
            [
                'label' => esc_html__('Name', 'elementor-multi-widgets'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .multi-testimonial-name',
            ]
        );
        
        $this->add_control(
            'position_heading',
            [
                'label' => esc_html__('Position', 'elementor-multi-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'position_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-position' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'selector' => '{{WRAPPER}} .multi-testimonial-position',
            ]
        );
        
        $this->add_control(
            'content_heading',
            [
                'label' => esc_html__('Content', 'elementor-multi-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-content' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .multi-testimonial-content',
            ]
        );
        
        $this->add_control(
            'rating_heading',
            [
                'label' => esc_html__('Rating', 'elementor-multi-widgets'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->add_control(
            'rating_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-rating i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'rating_size',
            [
                'label' => esc_html__('Size', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'rating_spacing',
            [
                'label' => esc_html__('Spacing', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-testimonial-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        if (!empty($settings['testimonials'])) {
            echo '<div class="multi-testimonials-wrapper">';
            
            foreach ($settings['testimonials'] as $testimonial) {
                echo '<div class="multi-testimonial-item">';
                echo '<div class="multi-testimonial-inner">';
                
                // Image
                if (!empty($testimonial['image']['url'])) {
                    echo '<div class="multi-testimonial-image">';
                    echo '<img src="' . esc_url($testimonial['image']['url']) . '" alt="' . esc_attr($testimonial['name']) . '">';
                    echo '</div>';
                }
                
                echo '<div class="multi-testimonial-content-wrap">';
                
                // Name and Position
                echo '<div class="multi-testimonial-meta">';
                if (!empty($testimonial['name'])) {
                    echo '<h3 class="multi-testimonial-name">' . esc_html($testimonial['name']) . '</h3>';
                }
                if (!empty($testimonial['position'])) {
                    echo '<span class="multi-testimonial-position">' . esc_html($testimonial['position']) . '</span>';
                }
                echo '</div>';
                
                // Rating
                if (!empty($testimonial['rating'])) {
                    echo '<div class="multi-testimonial-rating">';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $testimonial['rating']) {
                            echo '<i class="fas fa-star"></i>';
                        } else {
                            echo '<i class="far fa-star"></i>';
                        }
                    }
                    echo '</div>';
                }
                
                // Content
                if (!empty($testimonial['testimonial_content'])) {
                    echo '<div class="multi-testimonial-content">' . wp_kses_post($testimonial['testimonial_content']) . '</div>';
                }
                
                echo '</div>'; // .multi-testimonial-content-wrap
                echo '</div>'; // .multi-testimonial-inner
                echo '</div>'; // .multi-testimonial-item
            }
            
            echo '</div>'; // .multi-testimonials-wrapper
        }
    }
    
    protected function content_template() {
        ?>
        <#
        if (settings.testimonials.length) {
            print('<div class="multi-testimonials-wrapper">');
            
            _.each(settings.testimonials, function(item) {
                print('<div class="multi-testimonial-item">');
                print('<div class="multi-testimonial-inner">');
                
                // Image
                if (item.image.url) {
                    print('<div class="multi-testimonial-image">');
                    print('<img src="' + item.image.url + '" alt="' + item.name + '">');
                    print('</div>');
                }
                
                print('<div class="multi-testimonial-content-wrap">');
                
                // Name and Position
                print('<div class="multi-testimonial-meta">');
                if (item.name) {
                    print('<h3 class="multi-testimonial-name">' + item.name + '</h3>');
                }
                if (item.position) {
                    print('<span class="multi-testimonial-position">' + item.position + '</span>');
                }
                print('</div>');
                
                // Rating
                if (item.rating) {
                    print('<div class="multi-testimonial-rating">');
                    for (var i = 1; i <= 5; i++) {
                        if (i <= item.rating) {
                            print('<i class="fas fa-star"></i>');
                        } else {
                            print('<i class="far fa-star"></i>');
                        }
                    }
                    print('</div>');
                }
                
                // Content
                if (item.testimonial_content) {
                    print('<div class="multi-testimonial-content">' + item.testimonial_content + '</div>');
                }
                
                print('</div>'); // .multi-testimonial-content-wrap
                print('</div>'); // .multi-testimonial-inner
                print('</div>'); // .multi-testimonial-item
            });
            
            print('</div>'); // .multi-testimonials-wrapper
        }
        #>
        <?php
    }
}