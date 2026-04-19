<?php
/**
 * Minimal contact-form handler — posts to admin-post.php, sends via wp_mail().
 *
 * @package JocelyneBosschot
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function jb_handle_contact() {
	check_admin_referer( 'jb_contact', 'jb_contact_nonce' );

	$name    = isset( $_POST['name'] )    ? sanitize_text_field( wp_unslash( $_POST['name'] ) )    : '';
	$email   = isset( $_POST['email'] )   ? sanitize_email( wp_unslash( $_POST['email'] ) )        : '';
	$subject = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	$redirect = home_url( '/#contact' );

	if ( '' === $name || '' === $message || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'jb_contact', 'error', $redirect ) );
		exit;
	}

	$to      = apply_filters( 'jb_contact_to', get_option( 'admin_email' ) );
	$body    = sprintf( "Nom: %s\nE-mail: %s\nSujet: %s\n\n%s", $name, $email, $subject, $message );
	$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

	$sent = wp_mail( $to, '[Site] ' . $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'jb_contact', $sent ? 'sent' : 'error', $redirect ) );
	exit;
}
add_action( 'admin_post_nopriv_jb_contact', 'jb_handle_contact' );
add_action( 'admin_post_jb_contact', 'jb_handle_contact' );
