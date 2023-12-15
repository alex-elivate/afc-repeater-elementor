<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://elivate.net
 * @since      1.0.0
 *
 * @package    Afc_Repeater_Elementor
 * @subpackage Afc_Repeater_Elementor/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Afc_Repeater_Elementor
 * @subpackage Afc_Repeater_Elementor/includes
 * @author     Alex Trusler <alex.t@elivate.net>
 */
class Afc_Repeater_Elementor {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Afc_Repeater_Elementor_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'AFC_REPEATER_ELEMENTOR_VERSION' ) ) {
			$this->version = AFC_REPEATER_ELEMENTOR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'afc-repeater-elementor';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Afc_Repeater_Elementor_Loader. Orchestrates the hooks of the plugin.
	 * - Afc_Repeater_Elementor_i18n. Defines internationalization functionality.
	 * - Afc_Repeater_Elementor_Admin. Defines all hooks for the admin area.
	 * - Afc_Repeater_Elementor_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-afc-repeater-elementor-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-afc-repeater-elementor-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-afc-repeater-elementor-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-afc-repeater-elementor-public.php';

		$this->loader = new Afc_Repeater_Elementor_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Afc_Repeater_Elementor_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Afc_Repeater_Elementor_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Afc_Repeater_Elementor_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Afc_Repeater_Elementor_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
		add_shortcode('news-repeater', array($this, 'news_repeater_shortcode'));
	}
	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Afc_Repeater_Elementor_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
 	* Shortcode to display the repeater field
 	*
 	* @param array $atts
 	* @param null $content
 	* @param string $tag
 	* @return string
 	*/
	public function news_repeater_shortcode($atts = array(), $content = null, $tag = '') {
		$afc_repeater = 'news_entry'; // Name of the repeater field
		$title = 'title'; 
		$logo = 'logo';
		$link = 'link';
		$pageID = get_the_ID(); // not required if within loop, but doesn't hurt 

		// Log the page ID
		error_log("Page ID: $pageID");

		$content = '';

		while (have_rows($afc_repeater, $pageID)) {
			the_row();
			// Log the values of the sub fields
			error_log("Logo: " . get_sub_field($logo));
			error_log("Link: " . get_sub_field($link));
			error_log("Title: " . get_sub_field($title));

			// Sanitize the output
			$content .= '<div class="news-item">';
			$content .= '  <img class="news-logo" src="' . esc_url(get_sub_field($logo)) . '">';
			$content .= '  <a class="news-link" href="' . esc_url(get_sub_field($link)) . '">' . esc_html(get_sub_field($title)) . '</a>'; 
			$content .= '</div>';
		}

		// Log the final content
		error_log("Content: $content");

		return $content;
	}}
