<?php
/**
 * Enqueue scripts 
 *
 * @package  Custom plugin
 */

namespace CG\Base;

class Enqueue {

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_enqueue' ) );
	}

	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'pluginstyle', ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/admin.css' );
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js' );
		wp_enqueue_script( 'form-script', ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/form.js' );
		
		wp_localize_script('form-script', 'customAjax', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('custom-ajax-nonce') 
		));
	}

	function frontend_enqueue() {

		/* Check if debugging is on or not */

		$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

		// $plugin_data = get_plugin_data( ELEMENTOR_WIDGET_PLUGIN_PATH . '/calculators.php' );

		// Stylsheets.
		wp_enqueue_style( 'bootstrapstyle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css', array(), '5.2.2' );
		wp_enqueue_style( 'calculator-style', ELEMENTOR_WIDGET_PLUGIN_URL . 'assets/css/css.css', array(), 1 );

		wp_enqueue_script( 'font-awesome-script', 'https://kit.fontawesome.com/114bf9804b.js', array(), true, true );

	}
}