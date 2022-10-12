<?php
/**
 * Elementor Minopress WordPress Plugin
 *
 * @package Minopress
 *
 * Plugin Name: Elementor Minopress
 * Description: Simple Elementor widget plugin - Tutorial
 * Plugin URI:  https://minopress.com/
 * Version:     1.0
 * Author:      Avi Aminov
 * Author URI:  https://minopress.com/
 * Text Domain: elementor-minopress
 */

define('ELEMENTOR_MINOPRESS', __FILE__);

/**
 * Include the Elementor_Minopress class.
 */
require plugin_dir_path(ELEMENTOR_MINOPRESS) . 'class-elementor-minopress.php';
