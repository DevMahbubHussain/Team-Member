<?php

/**
 * Plugin Name:       Orbit Team Members
 * Plugin URI:        https://mahbub.com/plugins/orbit-team-members/
 * Description:       Orbit Team Members Plugin.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Mahbub Hussain
 * Author URI:        https://mahbub.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://mahbub.com/orbit-team-member/
 * Text Domain:       ot-team-member
 * Domain Path:       /languages
 *
 */

if (!defined('ABSPATH')) {
	exit;
}


/**
 * The Main Plugin Class
 */
final class Orbit_Team
{
	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const VERSION = '1.0';


	/**
	 * Plugin slug.
	 *
	 * @var string
	 *
	 */
	const SLUG = 'ot-team-member';


	/**
	 * Class construcotr
	 */
	private function __construct()
	{
		require_once __DIR__ . '/vendor/autoload.php';
		$this->ot_define_constants();
		// register_activation_hook(__FILE__, [$this, 'activate']);
		add_action('plugins_loaded', [$this, 'init_plugin']);
		add_action('init', [$this, 'localization_setup']);
		$this->ot_add_hooks();
	}

	/**
	 * Initializes a singleton instance
	 *
	 * @return \Orbit_Team
	 */
	public static function init()
	{
		static $instance = false;

		if (!$instance) {
			$instance = new self();
		}

		return $instance;
	}

	/**
	 * Define required plugin constants.
	 */
	public function ot_define_constants()
	{
		define('OT_TEAM_VERSION', self::VERSION);
		define('OT_TEAM_FILE', __FILE__);
		define('OT_TEAM_DIR', __DIR__);
		define('OT_TEAM_PATH', dirname(OT_TEAM_FILE));
		define('OT_TEAM_URL', plugins_url('', OT_TEAM_FILE));
		define('OT_TEAM_ASSETS', OT_TEAM_URL . '/src/assets');
		define('OT_TEAM_BUILD', OT_TEAM_URL . '/build');
		define('OT_TEAM_SLUG', self::SLUG);
		define('OT_TEAM_TEMPLATE_PATH', OT_TEAM_PATH . '/templates');
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init_plugin()
	{
		new Orbit\TeamMember\Assets\Manager();

		if ($this->is_request('admin') || $this->is_request('frontend')) {
			new Orbit\TeamMember\Admin();
		}
		if ($this->is_request('frontend')) {
			new Orbit\TeamMember\Frontend();
		}
	}

	private function is_request($type)
	{
		switch ($type) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined('DOING_AJAX');
			case 'rest':
				return defined('REST_REQUEST');
			case 'cron':
				return defined('DOING_CRON');
			case 'frontend':
				return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
			default:
				return false;
		}
	}

	private function ot_add_hooks()
	{
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'plugin_action_links']);
	}

	public function plugin_action_links($links)
	{
		$links[] = '<a href="' . admin_url('admin.php?page=team-member-settings') . '">' . __('Settings', 'ot-team-member') . '</a>';
		return $links;
	}

	public function localization_setup()
	{
		load_plugin_textdomain('ot-team-member', false, dirname(plugin_basename(__FILE__)) . '/languages');

		if (is_admin()) {
			// Load script translation for wp-scripts
			wp_set_script_translations('ot-team-js', 'ot-team-member', plugin_dir_path(__FILE__) . 'languages/');
		}
	}
}

/**
 * Initializes the main plugin
 *
 * @return \Orbit_Team
 */
function orbit_team()
{
	return Orbit_Team::init();
}

orbit_team();
