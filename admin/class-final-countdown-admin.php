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
class Final_Countdown_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	function finalCountdownAdmin()
	{

		add_menu_page(
			'Final Countdown',
			'Final Countdown',
			'administrator',
			'finalCountdownAdmin',
			'displayAdminPlugin',
			'dashicons-admin-page',
			50
		);

		add_submenu_page('options-general.php', 'Final Countdown', 'Final Countdown', 'administrator', 'finalCountdownAdmin', 'displayAdminPlugin');
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/final-countdown-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/final-countdown-admin.js', array('jquery'), $this->version, false);
	}
}

function displayAdminPlugin()
{
	include('partials/final-countdown-admin-display.php');
}

if (isset($_GET['action']) && $_GET['action'] === 'save-headband') {
	global $wpdb;
	$table_name = $wpdb->prefix . 'headband';
	$wpdb->insert(
		$table_name,
		array(
			'title' => sanitize_text_field($_POST['title']),
			'title_color' => sanitize_text_field($_POST['titleColor']),
			'text' => sanitize_text_field($_POST['text']),
			'text_color' => sanitize_text_field($_POST['textColor']),
			'bg_color' => sanitize_text_field($_POST['bg-color']),
			'start_timer' => sanitize_text_field($_POST['startTimer']),
			'end_timer' => sanitize_text_field($_POST['endTimer']),
		)
	);

	header('Location: http://test-plugins.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
};
function deleteAnnouncement()
{
	if (isset($_POST['deleteHeadband'])) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'headband';

		if (isset($_POST['id_headband'])) {
			$id_headband = intval($_POST['id_headband']);

			$wpdb->delete(
				$table_name,
				array('id_headband' => $id_headband),
				array('%d')
			);
		}
	}
}

function getAnnouncementForModify()
{
	if (isset($_POST['modifyHeadband'])) {
		$id_headband = intval($_POST['id_headband']);

		global $wpdb;
		$headbandModify = $wpdb->prefix . 'headband';
		$query = $wpdb->prepare("SELECT id_headband, title, title_color, text, text_color, bg_color, DATE_FORMAT(start_timer, '%%d/%%m/%%Y à %%H:%%i') AS start_timer, DATE_FORMAT(end_timer, '%%d/%%m/%%Y à %%H:%%i') AS end_timer FROM $headbandModify WHERE id_headband = %d", $id_headband);
		$resultForModify = $wpdb->get_results($query);
		return $resultForModify;
	}
}

if (isset($_POST['updateHeadband']) && isset($_POST['updateHeadband']) &&
isset($_POST['id_headband'])) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'headband';
	
		// Récupérez les valeurs des autres champs à partir du formulaire
		$id_headband = intval($_POST['id_headband']);
		$title = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
		$title_color = isset($_POST['titleColor']) ? sanitize_text_field($_POST['titleColor']) : '';
		$text = isset($_POST['text']) ? sanitize_text_field($_POST['text']) : '';
		$text_color = isset($_POST['textColor']) ? sanitize_text_field($_POST['textColor']) : '';
		$bg_color = isset($_POST['bg-color']) ? sanitize_text_field($_POST['bg-color']) : '';
		$start_timer = isset($_POST['startTimer']) ? sanitize_text_field($_POST['startTimer']) : '';
		$end_timer = isset($_POST['endTimer']) ? sanitize_text_field($_POST['endTimer']) : '';
	
		$wpdb->update(
			$table_name,
			array(
				'title' => $title,
				'title_color' => $title_color,
				'text' => $text,
				'text_color' => $text_color,
				'bg_color' => $bg_color,
				'start_timer' => $start_timer,
				'end_timer' => $end_timer,
			),
			array('id_headband' => $id_headband),
			array('%s', '%s', '%s', '%s', '%s', '%s', '%s')
		);

	}
	




function getAnnouncementInProgress()
{
	global $wpdb;
	$headband = $wpdb->prefix . 'headband';
	$query = "SELECT id_headband, title, title_color, text, text_color, bg_color, DATE_FORMAT(start_timer, '%d/%m/%Y à %H:%i') AS start_timer, DATE_FORMAT(end_timer, '%d/%m/%Y à %H:%i') AS end_timer FROM wp_headband WHERE end_timer > NOW();";
	$result = $wpdb->get_results($query);
	return $result;
}

function displayHeadband()
{
	include_once('C:\Users\aurel\Local Sites\test-plugins\app\public\wp-content\plugins\wp-final-countdown\admin\partials\final-countdown-admin-display.php');
};

add_shortcode('headband', 'displayHeadband');
