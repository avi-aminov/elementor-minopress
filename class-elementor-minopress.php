<?php
/**
 * Elementor_Minopress class.
 */

if (! defined('ABSPATH')) {
	// Exit if accessed directly.
	exit;
}

/**
 * Main Elementor Minopress Class
 */
final class ElementorMinopress
{
	/**
	 * Plugin Version
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Constructor
	 */
	public function __construct()
	{
		// Load the translation.
		add_action('init', [$this, 'i18n']);

		// Initialize the plugin.
		add_action('plugins_loaded', [$this, 'init']);
	}

	/**
	 * Load Textdomain
	 */
	public function i18n()
	{
		load_plugin_textdomain('elementor-minopress');
	}

	/**
	 * Initialize the plugin
	 */
	public function init()
	{
		// Check if Elementor installed and activated.
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
			return;
		}

		// Check for required Elementor version.
		if (! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
			return;
		}

		// Check for required PHP version.
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
			return;
		}

		// add custom widget categories
		add_action('elementor/elements/categories_registered', [$this, 'add_custom_elementor_widget_categories']);
		
		// include our widgets.
		require_once 'class-widgets.php';
	}

	/**
	 * Add custom elementor widget categories
	 */
	function add_custom_elementor_widget_categories($elements_manager)
	{
		$elements_manager->add_category(
			'minopress-category',
			[
				'title' => esc_html__('MinoPress', 'elementor-minopress'),
				'icon' => 'fa fa-plug',
			]
		);
	}
	
	/**
	 * Admin notice
	 * Warning when the site doesn't have Elementor installed or activated.
	 */
	public function admin_notice_missing_main_plugin()
	{
		deactivate_plugins(plugin_basename(ELEMENTOR_MINOPRESS));
		return sprintf(
			wp_kses(
				'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> to be installed and activated.</p></div>',
				[
					'div' => [
						'class'  => [],
						'p'      => [],
						'strong' => [],
					],
				]
			),
			'Elementor Minopress',
			'Elementor'
		);
	}

	/**
	 * Admin notice
	 * Warning when the site doesn't have a minimum required Elementor version.
	 */
	public function admin_notice_minimum_elementor_version()
	{
		deactivate_plugins(plugin_basename(ELEMENTOR_MINOPRESS));

		return sprintf(
			wp_kses(
				'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>',
				[
					'div' => [
						'class'  => [],
						'p'      => [],
						'strong' => [],
					],
				]
			),
			'Elementor Minopress',
			'Elementor',
			self::MINIMUM_ELEMENTOR_VERSION
		);
	}

	/**
	 * Admin notice
	 * Warning when the site doesn't have a minimum required PHP version.
	 */
	public function admin_notice_minimum_php_version()
	{
		deactivate_plugins(plugin_basename(ELEMENTOR_MINOPRESS));

		return sprintf(
			wp_kses(
				'<div class="notice notice-warning is-dismissible"><p><strong>"%1$s"</strong> requires <strong>"%2$s"</strong> version %3$s or greater.</p></div>',
				[
					'div' => [
						'class'  => [],
						'p'      => [],
						'strong' => [],
					],
				]
			),
			'Elementor Minopress',
			'Elementor',
			self::MINIMUM_ELEMENTOR_VERSION
		);
	}
}

// Instantiate ElementorMinopress.
new ElementorMinopress();