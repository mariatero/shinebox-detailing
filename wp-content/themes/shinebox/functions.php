<?php
/**
 * ShineBox theme bootstrap.
 *
 * @package ShineBox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SHINEBOX_VERSION', '1.1.0' );

require_once get_template_directory() . '/inc/i18n.php';
require_once get_template_directory() . '/inc/pricing.php';
require_once get_template_directory() . '/inc/contact-handler.php';

/**
 * Theme setup.
 */
function shinebox_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'shinebox' ),
		)
	);
}
add_action( 'after_setup_theme', 'shinebox_setup' );

/**
 * Enqueue styles and scripts.
 */
function shinebox_assets() {
	wp_enqueue_style(
		'shinebox-fonts',
		'https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Noto+Sans+Georgian:wght@400;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'shinebox-style',
		get_template_directory_uri() . '/assets/css/style.css',
		array(),
		SHINEBOX_VERSION
	);

	wp_enqueue_script(
		'shinebox-main',
		get_template_directory_uri() . '/assets/js/main.js',
		array(),
		SHINEBOX_VERSION,
		true
	);

	// Expose pricing data + ajax endpoint to the calculator/booking JS.
	wp_localize_script(
		'shinebox-main',
		'ShineBoxData',
		array(
			'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
			'nonce'     => wp_create_nonce( 'shinebox_booking' ),
			'lang'      => shinebox_current_lang(),
			'currency'  => '₾',
			'carTypes'  => shinebox_car_types(),
			'services'  => shinebox_services(),
			'strings'   => array(
				'from'        => shinebox_t( 'calc_from' ),
				'sending'     => shinebox_t( 'form_sending' ),
				'success'     => shinebox_t( 'form_success' ),
				'error'       => shinebox_t( 'form_error' ),
				'pickService' => shinebox_t( 'calc_pick_service' ),
			),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'shinebox_assets' );

/**
 * Add lang attribute helper class to <body>.
 */
function shinebox_body_class( $classes ) {
	$classes[] = 'lang-' . shinebox_current_lang();
	return $classes;
}
add_filter( 'body_class', 'shinebox_body_class' );
