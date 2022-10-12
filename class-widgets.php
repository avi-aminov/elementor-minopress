<?php
/**
 * Widgets class.
 *
 * @category   Class
 * @package    Minopress
 * @subpackage WordPress
 * @author     Avi Amionov <my@email.com>
 * @copyright  2022 Avi Aminov
 * @since      1.0.0
 * php version 7.4
 */

namespace Minopress;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Main Plugin class
 */
class Widgets
{

	/**
	 * The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Include Widgets files
	 */
	private function include_widgets_files()
	{
		require_once 'widgets/class-example.php';
	}

	/**
	 * Register new Elementor widgets.
	 */
	public function register_widgets()
	{
		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Register the plugin widget classes.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Example());
	}

	/**
	 *  Plugin class constructor
	 */
	public function __construct()
	{
		// Register the widgets.
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
	}
}

// Instantiate the Widgets class.
Widgets::instance();