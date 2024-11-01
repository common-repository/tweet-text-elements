<?php
/*
Plugin Name: Tweet Text Elements
Description: Provides tweet functionality for desired text elements within single posts.
Author: John Spellman
Version: 1.1
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

add_action( 'wp_enqueue_scripts', 'tte_script' );
function tte_script() {
	if ( is_single() ) {
		wp_enqueue_script( 'twitter_widgets', 'https://platform.twitter.com/widgets.js#asyncload' );
		wp_register_script( 'tte_custom_script', plugin_dir_url( __FILE__ ) . 'js/tte.js', array(
			'twitter_widgets',
			'jquery'
		) );
		$tte_settings = get_option( 'tte_settings' );
		wp_localize_script( 'tte_custom_script', 'tte_settings', $tte_settings );
		wp_enqueue_script( 'tte_custom_script' );
	}
}

// async load
// s/o https://ikreativ.com/async-with-wordpress-enqueue/
add_filter( 'clean_url', 'tte_async_scripts', 11, 1 );
function tte_async_scripts( $url ) {
	if ( strpos( $url, '#asyncload' ) === FALSE ) {
		return $url;
	} else {
		return str_replace( '#asyncload', '', $url ) . "' async='async";
	}
}

add_action( 'admin_menu', 'tte_add_admin_menu' );
add_action( 'admin_init', 'tte_settings_init' );
function tte_add_admin_menu() {
	add_submenu_page(
		'options-general.php',
		'Tweet Text Elements',
		'Tweet Elements',
		'manage_options',
		'tweet_elements',
		'tte_options_page' );
}

function tte_settings_init() {
	register_setting( 'tte', 'tte_settings', 'tte_sanitize_field' );
	add_settings_section(
		'tte_tte_section',
		__( 'Tweet Elements', 'js' ),
		'tte_settings_section_callback',
		'tte'
	);

	add_settings_field(
		'tte_jquery_selector',
		__( 'jQuery selector', 'js' ),
		'tte_jquery_selector_field_render',
		'tte',
		'tte_tte_section'
	);

	add_settings_field(
		'tte_link_text',
		__( 'Link text', 'js' ),
		'tte_link_text_field_render',
		'tte',
		'tte_tte_section'
	);

	add_settings_field(
		'tte_username',
		__( 'Twitter username', 'js' ),
		'tte_username_field_render',
		'tte',
		'tte_tte_section'
	);

	add_settings_field(
		'tte_page_url',
		__( 'Include URL to page in tweet?', 'js' ),
		'tte_page_url_field_render',
		'tte',
		'tte_tte_section'
	);
}

/**
 * Sanitize field data before saving to db
 *
 * @param $input
 *
 * @return array
 */
function tte_sanitize_field( $input ) {
	$data = array();

	$data['tte_link_text']       = ( ! empty( $input['tte_link_text'] ) ) ? sanitize_text_field( $input['tte_link_text'] ) : 'Tweet this';
	$data['tte_jquery_selector'] = ( ! empty( $input['tte_jquery_selector'] ) ) ? sanitize_text_field( $input['tte_jquery_selector'] ) : 'blockquote';
	$data['tte_username']        = ( ! empty( $input['tte_username'] ) ) ? sanitize_html_class( $input['tte_username'] ) : '';
	$data['tte_page_url']        = ( ! isset( $input['tte_page_url'] ) ) ? 0 : 1;

	return $data;
}

/**
 * Settings field markup
 */
function tte_link_text_field_render() {
	$options = get_option( 'tte_settings' ); ?>
    <input type='text' name='tte_settings[tte_link_text]'
           placeholder='Tweet this'
           value='<?php echo $options['tte_link_text']; ?>'/>
	<?php
}

function tte_jquery_selector_field_render() {
	$options = get_option( 'tte_settings' ); ?>
    <input type='text' name='tte_settings[tte_jquery_selector]'
           placeholder='blockquote'
           value='<?php echo $options['tte_jquery_selector']; ?>'/>
	<?php
}

function tte_username_field_render() {
	$options = get_option( 'tte_settings' ); ?>
    <input type='text' name='tte_settings[tte_username]'
           placeholder=''
           value='<?php echo $options['tte_username']; ?>'/>
	<?php
}

function tte_page_url_field_render() {
	$options = get_option( 'tte_settings' ); ?>
    <input type='checkbox'
           name='tte_settings[tte_page_url]'
           value='1' <?php checked( 1, $options['tte_page_url'], TRUE ); ?> />
	<?php
}

/**
 * Introductory section paragraph
 */
function tte_settings_section_callback() {
	echo __( 'Enter your settings below.', 'js' );
}

/**
 * Form output
 */
function tte_options_page() {
	?>
    <div class="wrap">
        <form action='options.php' method='post'>
			<?php
			settings_fields( 'tte' );
			do_settings_sections( 'tte' );
			submit_button(); ?>
        </form>
    </div>
	<?php
}