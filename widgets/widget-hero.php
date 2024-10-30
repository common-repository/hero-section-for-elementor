<?php 
namespace hero_for_elementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Heros
class Hero_widgets extends Widget_Base {
 
   public function get_name() {
      return 'hero';
   }
 
   public function get_title() {
      return esc_html__( 'Hero One', 'hero-for-elementor' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'hero-section', ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'style1_section',
         [
            'label' => esc_html__( 'Control', 'hero-for-elementor' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'hero-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('WILL SMITH','hero-for-elementor'),
         ]
      );

      $this->add_control(
        'title_color',
        [
          'label' => __( 'Title Color', 'hero-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .banner-content h2' => 'color: {{VALUE}}',
          ],
          'default' => '#878787'
        ]
      );

      $this->add_control(
         'about_text',
         [
            'label' => __( 'About Text', 'hero-for-elementor' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('I\'m Will Smith, professional web developer with long time experience in this field​.'),
         ]
      );


      $this->add_control(
        'about_text_color',
        [
          'label' => __( 'About Text Color', 'hero-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .banner-content p' => 'color: {{VALUE}}',
          ],
          'default' => '#8b98af'
        ]
      );


       $this->add_control(
           'hero_image',
           [
               'label' => __( 'Choose Image', 'plugin-domain' ),
               'type' => \Elementor\Controls_Manager::MEDIA,
               'default' => [
                   'url' => \Elementor\Utils::get_placeholder_image_src(),
               ],
           ]
       );

       $this->add_group_control(
      \Elementor\Group_Control_Image_Size::get_type(),
      [
        'name' => 'image_size', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
        'exclude' => [ 'custom' ],
        'include' => [],
        'default' => 'large',
      ]
    );

      $this->add_control(
        'button',
        [
           'label' => __( 'Button', 'hero-for-elementor' ),
           'type' => \Elementor\Controls_Manager::TEXT,
           'default' => __('See Portfolios','hero-for-elementor'),
        ]
      );

      $this->add_control(
        'button_color',
        [
          'label' => __( 'Button Color', 'hero-for-elementor' ),
          'type' => \Elementor\Controls_Manager::COLOR,
          'scheme' => [
            'type' => \Elementor\Scheme_Color::get_type(),
            'value' => \Elementor\Scheme_Color::COLOR_1,
          ],
          'selectors' => [
            '{{WRAPPER}} .banner-content a' => 'color: {{VALUE}}',
          ],
          'default' => '#878787'
        ]
      );

       $this->add_control(
           'button_hover_color',
           [
               'label' => __( 'Button Hover Color', 'hero-for-elementor' ),
               'type' => \Elementor\Controls_Manager::COLOR,
               'scheme' => [
                   'type' => \Elementor\Scheme_Color::get_type(),
                   'value' => \Elementor\Scheme_Color::COLOR_1,
               ],
               'selectors' => [
                   '{{WRAPPER}} .banner-content .btn::before' => 'color: {{VALUE}}',
               ],
               'default' => '#878787'
           ]
       );


       $this->add_control(
        'website_link',
        [
          'label' => __( 'Link', 'hero-for-elementor' ),
          'type' => \Elementor\Controls_Manager::URL,
          'placeholder' => __( 'https://your-link.com', 'hero-for-elementor' ),
          'show_external' => true,
          'default' => [
            'url' => '',
            'is_external' => true,
            'nofollow' => true,
          ],
        ]
      );

      $this->end_controls_section();


   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
      $settings = $this->get_settings_for_display(); 
      $target = $settings['website_link']['is_external'] ? ' target="_blank"' : '';
      $nofollow = $settings['website_link']['nofollow'] ? ' rel="nofollow"' : '';
      ?>
       <div class="container hsfe_bg">
           <div class="row align-items-center">
               <div class="col-xl-7 col-lg-6">
                   <div class="banner-content">
                       <h6 class="wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html__('Hello!','hero-for-elementor') ?></h6>
                       <h2 class="wow fadeInUp" data-wow-delay="0.4s"><?php echo esc_html__('I am','hero-for-elementor') ?> <?php echo esc_html($settings['title']); ?></h2>
                       <p class="wow fadeInUp" data-wow-delay="0.6s"><?php echo esc_html($settings['about_text']); ?></p>
                       <div class="banner-social wow fadeInUp" data-wow-delay="0.8s">
                           <ul>
                               <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                               <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                               <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                               <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                           </ul>
                       </div>
                       <a href="<?php echo esc_url( $settings['website_link']['url'] ) ?>"<?php esc_attr( $target . $nofollow ) ?> class="btn wow fadeInUp" data-wow-delay="1s"><?php echo esc_html($settings['button']); ?></a>
                   </div>
               </div>
               <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                   <div class="banner-img text-right">
                       <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'image_size', 'hero_image') ?>
                      
                   </div>
               </div>
           </div>
       </div>
       <div class="banner-shape"><?php echo '<img class="rotateme" src="' . esc_url( plugins_url( '../assets/images/dot_circle.png', __FILE__ ) ) . '" > ';?></div>
      <?php
   }
 
}