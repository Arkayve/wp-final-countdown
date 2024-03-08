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

	function finalCountdownAdmin() {

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

session_start();

function displayAdminPlugin()
{
	include('partials/final-countdown-admin-display.php');
}

// Create new headband
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
			'display_headband' => true,
			'display_text' => true,
			'height' => sanitize_text_field($_POST['height']),
        )
	);
	if (strlen($_FILES['bg-img']['name']) > 0) {
		$lastId = $wpdb->insert_id;
		include ('file-upload.php');
	};
	header('Location: http://wp-plugin.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
}

// Delete headband
else if (isset($_GET['action']) && $_GET['action'] === 'del-headband' && isset($_GET['id'])) {
	global $wpdb;
	$query = "SELECT id_file, file_name FROM wp_headband_files WHERE id_headband = " . intval($_GET['id']);
	$result = $wpdb->get_results( $query );
	if (!empty($result) && isset($result[0])) {
		$wpdb->delete('wp_headband_files', array('id_headband' => $_GET['id']));
		unlink('C:/Users/fwcha/Local Sites/wp-plugin/app/public/wp-content/plugins/final-countdown/admin/uploads/' . $result[0]->file_name);		
	};
	$wpdb->delete('wp_headband', array('id_headband' => $_GET['id']));
	header('Location: http://wp-plugin.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
}

// Get headband to modify
else if (isset($_GET['action']) && $_GET['action'] === 'mod-headband' && isset($_GET['id'])) {
	global $wpdb;
	$query = "SELECT * FROM wp_headband LEFT JOIN wp_headband_files USING (id_headband) WHERE id_headband = " . $_GET['id'];
	$result = $wpdb->get_results( $query );
	$_SESSION['result'] = $result[0];
	header('Location: http://wp-plugin.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
}

// Update headband
else if (isset($_GET['action']) && $_GET['action'] === 'modify-headband' && isset($_GET['id'])) {
	global $wpdb;
	$wpdb->update('wp_headband', array(
		'title' => sanitize_text_field($_POST['title']),
		'title_color' => sanitize_text_field($_POST['titleColor']),
		'text' => sanitize_text_field($_POST['text']),
		'text_color' => sanitize_text_field($_POST['textColor']),
		'bg_color' => sanitize_text_field($_POST['bg-color']),
		'start_timer' => sanitize_text_field($_POST['startTimer']),
		'end_timer' => sanitize_text_field($_POST['endTimer']),
		'height' => sanitize_text_field($_POST['height']),
	), array(
		'id_headband' => $_GET['id']
	));
	if (strlen($_FILES['bg-img']['name']) > 0) {
		$lastId = $_GET['id'];
		include ('file-modify.php');
	};
	header('Location: http://wp-plugin.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
}

// Display headband
else if (isset($_GET['action']) && $_GET['action'] === 'display-headband' && isset($_GET['id'])) {
	global $wpdb;
	$displayHeadband = intval($_POST['display-headband']) === 1 ? false : true;
	$wpdb->update('wp_headband', array('display_headband' => $displayHeadband), array('id_headband' => $_GET['id']));
	header('Location: http://wp-plugin.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
}

// Display text
else if (isset($_GET['action']) && $_GET['action'] === 'display-text' && isset($_GET['id'])) {
	global $wpdb;
	$displayText = intval($_POST['display-text']) === 1 ? false : true;
	$wpdb->update('wp_headband', array('display_text' => $displayText), array('id_headband' => $_GET['id']));
	header('Location: http://wp-plugin.local/wp-admin/admin.php?page=finalCountdownAdmin');
	exit;
};

function getAnnouncementInProgress ($bool) {
	global $wpdb;
	$display = $bool ? ' AND start_timer < NOW() AND display_headband = 1' : '';
	$query = "SELECT id_headband, title, title_color, text, text_color, bg_color, DATE_FORMAT(start_timer, '%d/%m/%Y à %H:%i') AS start_timer, DATE_FORMAT(end_timer, '%d/%m/%Y à %H:%i') AS end_timer, display_headband, display_text, height, file_name FROM wp_headband LEFT JOIN wp_headband_files USING (id_headband) WHERE end_timer > NOW()" . $display;
	$result = $wpdb->get_results( $query );
	return $result;
}

function displayHeadband() {
	include_once ('C:\Users\fwcha\Local Sites\wp-plugin\app\public\wp-content\plugins\final-countdown\public\partials\final-countdown-public-display.php');
};

add_shortcode('headband', 'displayHeadband');