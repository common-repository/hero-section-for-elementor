<?php
namespace hero_for_elementor;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_categories
	 *
	 * Register new category for widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'hero-section',
			[
				'title' => esc_html__( 'Hero Sections for elemntor', 'megaaddons' ),
				'icon' => 'fa fa-plug',
			]
		);

	}


	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_enqueue_style( 'info-boxes', plugins_url( '/assets/css/infobox.css', __FILE__ ) );
		wp_enqueue_style( 'bootstrap', plugins_url( '/assets/css/bootstrap.min.css', __FILE__ ) );
		wp_enqueue_style( 'animate', plugins_url( '/assets/css/animate.min.css', __FILE__ ) );
		wp_enqueue_script( 'info-boxes', plugins_url( '/assets/js/infobox.js', __FILE__ ), [ 'jquery' ], false, true );
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/widget-hero.php' );
		require_once( __DIR__ . '/widgets/widget-hero2.php' );
		require_once( __DIR__ . '/widgets/widget-hero3.php' );

  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Hero_widgets() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Hero_widgets2() );
  		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Hero_widgets3() );


	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}
}

// Instantiate Plugin Class
Plugin::instance();
