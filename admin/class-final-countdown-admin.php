<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://aurelien.net
 * @since      1.0.0
 *
 * @package    Final_Countdown
 * @subpackage Final_Countdown/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Final_Countdown
 * @subpackage Final_Countdown/admin
 * @author     Aurélien <aure@lien.com>
 */
class Final_Countdown_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	function am_countdown_plugin() {

		add_menu_page(
			'Final Countdown',
			'Final Countdown',
			'administrator',
			'countdown_plugin',
			'countdown_plugin_function',
			'dashicons-admin-page',
			50
		);
	
		add_submenu_page('options-general.php', 'Final Countdown', 'Final Countdown', 'administrator', 'countdown_plugin', 'countdown_plugin_function');
	
	}

	// add_shortcode('countdown', 'countdown_shortcode');

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Final_Countdown_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Final_Countdown_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/final-countdown-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Final_Countdown_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Final_Countdown_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/final-countdown-admin.js', array( 'jquery' ), $this->version, false );

	}

}

function countdown_plugin_function()
{
	include('partials/final-countdown-admin-display.php');
	wp_enqueue_script('countdown-script', plugin_dir_url(__FILE__) . '/js/final-countdown-admin.js', array('jquery'), null, true);
}