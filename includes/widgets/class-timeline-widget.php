<?php
namespace ElementorMultiWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit;
}

class Timeline_Widget extends Widget_Base {
    
    public function get_name() {
        return 'multi_timeline';
    }
    
    public function get_title() {
        return esc_html__('Timeline', 'elementor-multi-widgets');
    }
    
    public function get_icon() {
        return 'eicon-time-line';
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
            'timeline_date',
            [
                'label' => esc_html__('Date', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('January 2023', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'timeline_title',
            [
                'label' => esc_html__('Title', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Timeline Item', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'timeline_content',
            [
                'label' => esc_html__('Content', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'timeline_icon',
            [
                'label' => esc_html__('Icon', 'elementor-multi-widgets'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-calendar',
                    'library' => 'fa-solid',
                ],
            ]
        );
        
        $this->add_control(
            'timeline_items',
            [
                'label' => esc_html__('Timeline Items', 'elementor-multi-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'timeline_date' => esc_html__('January 2023', 'elementor-multi-widgets'),
                        'timeline_title' => esc_html__('Project Started', 'elementor-multi-widgets'),
                        'timeline_content' => esc_html__('We began working on this amazing project with our talented team.', 'elementor-multi-widgets'),
                    ],
                    [
                        'timeline_date' => esc_html__('March 2023', 'elementor-multi-widgets'),
                        'timeline_title' => esc_html__('First Milestone', 'elementor-multi-widgets'),
                        'timeline_content' => esc_html__('Completed the first phase of the project successfully.', 'elementor-multi-widgets'),
                    ],
                    [
                        'timeline_date' => esc_html__('June 2023', 'elementor-multi-widgets'),
                        'timeline_title' => esc_html__('Project Launch', 'elementor-multi-widgets'),
                        'timeline_content' => esc_html__('Successfully launched the project to the public.', 'elementor-multi-widgets'),
                    ],
                ],
                'title_field' => '{{{ timeline_title }}}',
            ]
        );
        
        $this->add_control(
            'timeline_style',
            [
                'label' => esc_html__('Style', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical' => esc_html__('Vertical', 'elementor-multi-widgets'),
                    'horizontal' => esc_html__('Horizontal', 'elementor-multi-widgets'),
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Tab
        $this->style_tab();
    }
    
    private function style_tab() {
        // Timeline Style
        $this->start_controls_section(
            'timeline_style_section',
            [
                'label' => esc_html__('Timeline', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'line_color',
            [
                'label' => esc_html__('Line Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-vertical .multi-timeline-line' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .multi-timeline-horizontal .multi-timeline-line' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'line_width',
            [
                'label' => esc_html__('Line Width', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-vertical .multi-timeline-line' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .multi-timeline-horizontal .multi-timeline-line' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Item Style
        $this->start_controls_section(
            'item_style_section',
            [
                'label' => esc_html__('Item', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'item_bg',
            [
                'label' => esc_html__('Background Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .multi-timeline-item',
            ]
        );
        
        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .multi-timeline-item',
            ]
        );
        
        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'item_margin',
            [
                'label' => esc_html__('Margin', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Icon Style
        $this->start_controls_section(
            'icon_style_section',
            [
                'label' => esc_html__('Icon', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-icon i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'icon_bg',
            [
                'label' => esc_html__('Background Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Size', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'icon_box_size',
            [
                'label' => esc_html__('Box Size', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'selector' => '{{WRAPPER}} .multi-timeline-icon',
            ]
        );
        
        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
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
                    '{{WRAPPER}} .multi-timeline-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Date Style
        $this->start_controls_section(
            'date_style_section',
            [
                'label' => esc_html__('Date', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'date_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-date' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .multi-timeline-date',
            ]
        );
        
        $this->add_control(
            'date_spacing',
            [
                'label' => esc_html__('Spacing', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-date' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Title Style
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__('Title', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .multi-timeline-title',
            ]
        );
        
        $this->add_control(
            'title_spacing',
            [
                'label' => esc_html__('Spacing', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Content Style
        $this->start_controls_section(
            'content_style_section',
            [
                'label' => esc_html__('Content', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-timeline-content' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .multi-timeline-content',
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $timeline_style = $settings['timeline_style'];
        
        if (!empty($settings['timeline_items'])) {
            echo '<div class="multi-timeline-wrapper multi-timeline-' . esc_attr($timeline_style) . '">';
            echo '<div class="multi-timeline-line"></div>';
            echo '<div class="multi-timeline-items">';
            
            foreach ($settings['timeline_items'] as $item) {
                echo '<div class="multi-timeline-item">';
                echo '<div class="multi-timeline-icon">';
                \Elementor\Icons_Manager::render_icon($item['timeline_icon'], ['aria-hidden' => 'true']);
                echo '</div>';
                
                echo '<div class="multi-timeline-content-wrap">';
                if (!empty($item['timeline_date'])) {
                    echo '<div class="multi-timeline-date">' . esc_html($item['timeline_date']) . '</div>';
                }
                if (!empty($item['timeline_title'])) {
                    echo '<h3 class="multi-timeline-title">' . esc_html($item['timeline_title']) . '</h3>';
                }
                if (!empty($item['timeline_content'])) {
                    echo '<div class="multi-timeline-content">' . wp_kses_post($item['timeline_content']) . '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
            
            echo '</div>'; // .multi-timeline-items
            echo '</div>'; // .multi-timeline-wrapper
        }
    }
    
    protected function content_template() {
        ?>
        <#
        if (settings.timeline_items.length) {
            var timeline_style = settings.timeline_style;
            print('<div class="multi-timeline-wrapper multi-timeline-' + timeline_style + '">');
            print('<div class="multi-timeline-line"></div>');
            print('<div class="multi-timeline-items">');
            
            _.each(settings.timeline_items, function(item) {
                print('<div class="multi-timeline-item">');
                print('<div class="multi-timeline-icon">');
                var iconHTML = elementor.helpers.renderIcon(view, item.timeline_icon, { 'aria-hidden': true }, 'i' , 'object' );
                print(iconHTML.value);
                print('</div>');
                
                print('<div class="multi-timeline-content-wrap">');
                if (item.timeline_date) {
                    print('<div class="multi-timeline-date">' + item.timeline_date + '</div>');
                }
                if (item.timeline_title) {
                    print('<h3 class="multi-timeline-title">' + item.timeline_title + '</h3>');
                }
                if (item.timeline_content) {
                    print('<div class="multi-timeline-content">' + item.timeline_content + '</div>');
                }
                print('</div>');
                print('</div>');
            });
            
            print('</div>'); // .multi-timeline-items
            print('</div>'); // .multi-timeline-wrapper
        }
        #>
        <?php
    }
}