<?php
/**
 * Plugin Name: Elementor Testimonial Carousel
 * Plugin URL: -
 * Description: Elementor Testimonial Carousel Widget
 * Version: 1.0.0
 * Author: Tantri Mindrawan
 * Author URI: -
 * License: GPLv2 or Later
 * Text Domain: ele-testimonial
 */

if ( ! defined( 'ABSPATH' ) ):
	die( 'Forbidden' );
endif;

define( 'ETC_VERSION', '1.0.0' );
define( 'ETC_MIN_WP_VERSION', '5.6' );
define( 'ETC_PLUGIN_FILE', __FILE__ );
define( 'ETC_PLUGIN_DIR', plugin_dir_path( ETC_PLUGIN_FILE ) );
define( 'ETC_PLUGIN_URI', plugin_dir_url( ETC_PLUGIN_FILE ) );
define( 'ETC_PLUGIN_SLUG', plugin_basename( ETC_PLUGIN_FILE ) );
define( 'ETC_MIN_ELEMENTOR_VERSION', '3.5.0' );

/**
 * Load Get Text
 */
function etc_load_plugin() {
    load_plugin_textdomain( 'ele-testimonial' );

    if( ! did_action( 'elementor/loaded' ) ):
        add_action( 'admin_notices', 'etc_fail_load' );

        return;
    endif;


    $elementor_version_required = ETC_MIN_ELEMENTOR_VERSION;
    if( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ):
        add_action( 'admin_notices', 'etc_fail_load_out_of_date' );
        echo "ok";

        return;
    endif;

    require ETC_PLUGIN_DIR . 'plugin.php';
}

add_action( 'plugins_loaded', 'etc_load_plugin' );

function display_error( $message ) {
    if( ! $message ):
        return;
    endif;

    echo sprintf( '<div class="etc-error">%s</div>', $message );
}

/**
 * Show in Admin Notice when not activated
 */
function etc_fail_load() {
    $screen = get_current_screen();

    if( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ):
        return;
    endif;

    $elementor_plugin = 'elementor/elementor.php';

    if( _etc_is_elementor_installed() ):
        if( ! current_user_can( 'activate_plugins' ) ):
            return;
        endif;

        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor_plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor_plugin );

		$message = '<h3>' . esc_html__( 'Activate the Elementor Plugin', 'ele-testimonial' ) . '</h3>';
		$message .= '<p>' . esc_html__( 'Before you can use Elementor Testimonial Carousel Plugin, you need to activate the Elementor plugin first.', 'ele-testimonial' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Now', 'ele-testimonial' ) ) . '</p>';
    else:
        if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

		$message = '<h3>' . esc_html__( 'Install and Activate the Elementor Plugin', 'ele-testimonial' ) . '</h3>';
		$message .= '<p>' . esc_html__( 'Before you can use Elementor Testimonial Carousel Plugin, you need to install and activate the Elementor plugin first.', 'ele-testimonial' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor', 'ele-testimonial' ) ) . '</p>';
    endif;

    display_error( $message );
}

if( ! function_exists( '_etc_is_elementor_installed' ) ):
    function _etc_is_elementor_installed() {
        $file_path = 'elementor/elementor.php';
        $installed_plugins = get_plugins();

        return isset( $installed_plugins[ $file_path ] );
    }
endif;


/**
 * Admin Notice Load Out of Date
 */
function etc_fail_load_out_of_date() {
    if( ! current_user_can( 'activate_plugins' ) ):
        return;
    endif;

    $elementor_file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $elementor_file_path, 'upgrade-plugin_' . $elementor_file_path );
	$message = '<p>' . esc_html__( 'Elementor Testimonial Carousel is not working because you are using an old version of Elementor.', 'ele-testimonial' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, esc_html__( 'Update Elementor Now', 'ele-testimonial' ) ) . '</p>';

    display_error( $message );
}