<?php
/**
 * Booking form handler — emails the request to the business.
 *
 * Submissions are sent via admin-ajax (action: shinebox_booking) for both
 * logged-in and anonymous visitors. Set the destination address in the
 * Customizer (Appearance → Customize → ShineBox) or change the default below.
 *
 * @package ShineBox
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Where booking requests are emailed.
 *
 * @return string
 */
function shinebox_booking_email() {
	$custom = get_option( 'shinebox_email' );
	return $custom ? $custom : get_option( 'admin_email' );
}

/**
 * Handle a booking form submission.
 */
function shinebox_handle_booking() {
	check_ajax_referer( 'shinebox_booking', 'nonce' );

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$car     = isset( $_POST['car'] ) ? sanitize_text_field( wp_unslash( $_POST['car'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	if ( '' === $name || '' === $phone ) {
		wp_send_json_error( array( 'message' => 'missing_fields' ), 400 );
	}

	$to      = shinebox_booking_email();
	$subject = sprintf( '[ShineBox] New booking request from %s', $name );
	$body    = sprintf(
		"New booking request:\n\nName: %s\nPhone: %s\nCar: %s\n\nMessage:\n%s\n",
		$name,
		$phone,
		$car ? $car : '—',
		$message ? $message : '—'
	);
	$headers = array( 'Content-Type: text/plain; charset=UTF-8' );

	$sent = wp_mail( $to, $subject, $body, $headers );

	if ( $sent ) {
		wp_send_json_success();
	}
	wp_send_json_error( array( 'message' => 'mail_failed' ), 500 );
}
add_action( 'wp_ajax_shinebox_booking', 'shinebox_handle_booking' );
add_action( 'wp_ajax_nopriv_shinebox_booking', 'shinebox_handle_booking' );

/**
 * Contact / social settings in the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function shinebox_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'shinebox_contact',
		array(
			'title'    => __( 'ShineBox — Contact & Social', 'shinebox' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'shinebox_email'     => array( 'label' => __( 'Booking email', 'shinebox' ), 'default' => '' ),
		'shinebox_phone'     => array( 'label' => __( 'Phone number', 'shinebox' ), 'default' => '+995 555 00 00 00' ),
		'shinebox_whatsapp'  => array( 'label' => __( 'WhatsApp number (digits only, with country code)', 'shinebox' ), 'default' => '995555000000' ),
		'shinebox_instagram' => array( 'label' => __( 'Instagram URL', 'shinebox' ), 'default' => '' ),
		'shinebox_facebook'  => array( 'label' => __( 'Facebook URL', 'shinebox' ), 'default' => '' ),
	);

	foreach ( $fields as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $args['label'],
				'section' => 'shinebox_contact',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'shinebox_customize_register' );

/**
 * Convenience getter for a contact/social setting.
 *
 * @param string $key     Option key without the shinebox_ prefix is NOT assumed; pass full key.
 * @param string $default Fallback.
 * @return string
 */
function shinebox_opt( $key, $default = '' ) {
	$val = get_option( $key );
	return $val ? $val : $default;
}

/**
 * Build a WhatsApp click-to-chat URL with a prefilled message.
 *
 * @param string $text Prefilled message.
 * @return string
 */
function shinebox_whatsapp_url( $text = '' ) {
	$number = preg_replace( '/\D/', '', shinebox_opt( 'shinebox_whatsapp', '995555000000' ) );
	$url    = 'https://wa.me/' . $number;
	if ( $text ) {
		$url = add_query_arg( 'text', rawurlencode( $text ), $url );
	}
	return $url;
}
