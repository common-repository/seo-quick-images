<?php
/**
 * Loads the plugin files
 *
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

class ClassSEO_IMAGES {
	
	function __construct() {
		require_once SEO_IMAGES_PATH_ABS . 'admin/admin-general-setting.php';
		add_action('admin_print_styles', array($this, 'seo_images_stylesheet'));
		add_action('admin_print_styles', array($this, 'addAjaxToPluginseo_images'));
	}

	public function seo_images_stylesheet() {
		wp_enqueue_style('seo_images_style', plugins_url('/assets/css/seo_images_style.css', __FILE__), array(), rand(111, 9999), 'all');
		// wp_enqueue_script('seo_images_script', plugins_url('/assets/js/seo_images_script.js', __FILE__), array(), rand(111, 9999), 'all');
	}

	public function addAjaxToPluginseo_images() {
		wp_register_script('ajaxHandle', plugins_url('/assets/js/seo_images_ajax_script.js', __FILE__), array(), rand(111, 9999), true);
		wp_enqueue_script('ajaxHandle');
		wp_localize_script('ajaxHandle', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php'), 'seo_images_save_draft_nonce' => wp_create_nonce( 'seo_images_save_draft_nonce' ) ) );

	}
}
$pluginSEO_IMAGES = new ClassSEO_IMAGES();