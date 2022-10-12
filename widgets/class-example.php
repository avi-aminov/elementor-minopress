<?php
/**
 * Awesomesauce class.
 *
 * @category   Class
 * @package    Minopress
 * @subpackage WordPress
 * @author     Avi Amionov <my@email.com>
 * @copyright  2022 Avi Aminov
 * @since      1.0.0
 * php version 7.4
 */

namespace Minopress\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined('ABSPATH') || die();

/**
 * Awesomesauce widget class.
 *
 * @since 1.0.0
 */
class Example extends Widget_Base
{
	/**
	 * Class constructor.
	 */
	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		wp_register_style(
			'elementor-minopress-style',
			plugins_url('/assets/css/minopress.css', ELEMENTOR_MINOPRESS),
			[],
			'1.0.0'
		);
	}

	/**
	 * return widget name.
	 */
	public function get_name()
	{
		return 'Example';
	}

	/**
	 * return widget title.
	 */
	public function get_title()
	{
		return __('Example', 'elementor-minopress');
	}

	/**
	 * return widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-post-excerpt';
	}

	/**
	 * return widget categories.
	 */
	public function get_categories()
	{
		return ['minopress-category'];
	}
	
	/**
	 * Enqueue styles.
	 */
	public function get_style_depends()
	{
		return ['example'];
	}

	/**
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => __('Content', 'elementor-minopress'),
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __('Title', 'elementor-minopress'),
				'type'    => Controls_Manager::TEXT,
				'default' => __('Title', 'elementor-minopress'),
			]
		);

		$this->add_control(
			'content',
			[
				'label'   => __('Content', 'elementor-minopress'),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __('Content', 'elementor-minopress'),
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('content', 'advanced');
		?>
		<h2 <?php echo $this->get_render_attribute_string('title'); ?>>
			<?php echo wp_kses($settings['title'], []); ?>
		</h2>
		<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
			<?php echo wp_kses($settings['content'], []); ?>
		</div>
		<?php
	}

	/**
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */
	protected function _content_template()
	{
		?>
			<#
			view.addInlineEditingAttributes('title', 'none');
			view.addInlineEditingAttributes('content', 'advanced');
			#>
			<h2 {{{ view.getRenderAttributeString('title') }}}>{{{ settings.title }}}</h2>
			<div {{{ view.getRenderAttributeString('content') }}}>{{{ settings.content }}}</div>
		<?php
	}
}