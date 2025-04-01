<?php
namespace ElementorMultiWidgets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit;
}

class Cards_Widget extends Widget_Base {
    
    public function get_name() {
        return 'multi_cards';
    }
    
    public function get_title() {
        return esc_html__('Clickable Cards', 'elementor-multi-widgets');
    }
    
    public function get_icon() {
        return 'eicon-cards';
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
            'card_image',
            [
                'label' => esc_html__('Image', 'elementor-multi-widgets'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'card_title',
            [
                'label' => esc_html__('Title', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Card Title', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'card_description',
            [
                'label' => esc_html__('Description', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor-multi-widgets'),
            ]
        );
        
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'elementor-multi-widgets'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-multi-widgets'),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        
        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-multi-widgets'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Learn More', 'elementor-multi-widgets'),
            ]
        );
        
        $this->add_control(
            'cards',
            [
                'label' => esc_html__('Cards', 'elementor-multi-widgets'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'card_title' => esc_html__('Card 1', 'elementor-multi-widgets'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'elementor-multi-widgets'),
                    ],
                    [
                        'card_title' => esc_html__('Card 2', 'elementor-multi-widgets'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'elementor-multi-widgets'),
                    ],
                    [
                        'card_title' => esc_html__('Card 3', 'elementor-multi-widgets'),
                        'card_description' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'elementor-multi-widgets'),
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );
        
        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => esc_html__('1', 'elementor-multi-widgets'),
                    '2' => esc_html__('2', 'elementor-multi-widgets'),
                    '3' => esc_html__('3', 'elementor-multi-widgets'),
                    '4' => esc_html__('4', 'elementor-multi-widgets'),
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Style Tab
        $this->style_tab();
    }
    
    private function style_tab() {
        // Card Style
        $this->start_controls_section(
            'card_style_section',
            [
                'label' => esc_html__('Card', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'card_bg',
            [
                'label' => esc_html__('Background Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'card_bg_gradient',
                'label' => esc_html__('Background', 'elementor-multi-widgets'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .multi-card',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .multi-card',
            ]
        );
        
        $this->add_control(
            'card_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .multi-card',
            ]
        );
        
        $this->add_control(
            'card_padding',
            [
                'label' => esc_html__('Padding', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_margin',
            [
                'label' => esc_html__('Margin', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'card_hover_effect',
            [
                'label' => esc_html__('Hover Effect', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SELECT,
                'default' => 'lift',
                'options' => [
                    'none' => esc_html__('None', 'elementor-multi-widgets'),
                    'lift' => esc_html__('Lift', 'elementor-multi-widgets'),
                    'shadow' => esc_html__('Shadow', 'elementor-multi-widgets'),
                    'grow' => esc_html__('Grow', 'elementor-multi-widgets'),
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Image Style
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => esc_html__('Image', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'image_height',
            [
                'label' => esc_html__('Height', 'elementor-multi-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'image_margin',
            [
                'label' => esc_html__('Margin', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .multi-card-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .multi-card-title',
            ]
        );
        
        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Description Style
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => esc_html__('Description', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card-description' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .multi-card-description',
            ]
        );
        
        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__('Margin', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        // Button Style
        $this->start_controls_section(
            'button_style_section',
            [
                'label' => esc_html__('Button', 'elementor-multi-widgets'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Text Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'button_bg',
            [
                'label' => esc_html__('Background Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .multi-card-button',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .multi-card-button',
            ]
        );
        
        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'elementor-multi-widgets'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Hover Text Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'button_hover_bg',
            [
                'label' => esc_html__('Hover Background Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Hover Border Color', 'elementor-multi-widgets'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .multi-card-button:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
    protected function render() {
        $settings = $this->get_settings_for_display();
        $columns = $settings['columns'];
        
        if (!empty($settings['cards'])) {
            echo '<div class="multi-cards-wrapper multi-cards-columns-' . esc_attr($columns) . '">';
            
            foreach ($settings['cards'] as $card) {
                $target = $card['link']['is_external'] ? ' target="_blank"' : '';
                $nofollow = $card['link']['nofollow'] ? ' rel="nofollow"' : '';
                
                echo '<div class="multi-card multi-card-effect-' . esc_attr($settings['card_hover_effect']) . '">';
                if (!empty($card['link']['url'])) {
                    echo '<a href="' . esc_url($card['link']['url']) . '"' . $target . $nofollow . ' class="multi-card-link">';
                }
                
                if (!empty($card['card_image']['url'])) {
                    echo '<div class="multi-card-image">';
                    echo '<img src="' . esc_url($card['card_image']['url']) . '" alt="' . esc_attr($card['card_title']) . '">';
                    echo '</div>';
                }
                
                echo '<div class="multi-card-body">';
                if (!empty($card['card_title'])) {
                    echo '<h3 class="multi-card-title">' . esc_html($card['card_title']) . '</h3>';
                }
                if (!empty($card['card_description'])) {
                    echo '<div class="multi-card-description">' . wp_kses_post($card['card_description']) . '</div>';
                }
                if (!empty($card['button_text'])) {
                    echo '<div class="multi-card-button">' . esc_html($card['button_text']) . '</div>';
                }
                echo '</div>';
                
                if (!empty($card['link']['url'])) {
                    echo '</a>';
                }
                echo '</div>';
            }
            
            echo '</div>';
        }
    }
    
    protected function content_template() {
        ?>
        <#
        if (settings.cards.length) {
            var columns = settings.columns;
            print('<div class="multi-cards-wrapper multi-cards-columns-' + columns + '">');
            
            _.each(settings.cards, function(card) {
                var target = card.link.is_external ? ' target="_blank"' : '';
                var nofollow = card.link.nofollow ? ' rel="nofollow"' : '';
                
                print('<div class="multi-card multi-card-effect-' + settings.card_hover_effect + '">');
                if (card.link.url) {
                    print('<a href="' + card.link.url + '"' + target + nofollow + ' class="multi-card-link">');
                }
                
                if (card.card_image.url) {
                    print('<div class="multi-card-image">');
                    print('<img src="' + card.card_image.url + '" alt="' + card.card_title + '">');
                    print('</div>');
                }
                
                print('<div class="multi-card-body">');
                if (card.card_title) {
                    print('<h3 class="multi-card-title">' + card.card_title + '</h3>');
                }
                if (card.card_description) {
                    print('<div class="multi-card-description">' + card.card_description + '</div>');
                }
                if (card.button_text) {
                    print('<div class="multi-card-button">' + card.button_text + '</div>');
                }
                print('</div>');
                
                if (card.link.url) {
                    print('</a>');
                }
                print('</div>');
            });
            
            print('</div>');
        }
        #>
        <?php
    }
}