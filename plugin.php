<?php
if ( ! defined( 'ABSPATH' ) ):
	exit; // Exit if accessed directly
endif;

/**
 * Register New Category Elementor
 */
function add_elementor_widget_categories( $elements_manager ) {
    $elements_manager->add_category(
        'etc-widget',
        [
            'title' => __( 'ETC Widget', 'ele-testimonial' ),
            'icon' => 'fa fa-plug'
        ]
    );
}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories' );


class Plugin {

    protected static $instance = null;

    public static function get_instance() {
        if( ! isset( static::$instance ) ):
            static::$instance = new static;
        endif;

        return static::$instance;
    }

    protected function __construct() {
        require_once( 'widget/widget.php' );

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widget' ] );
    }

    public function register_widget() {

        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\ETC_Testimonial_Carousel() );

    }

}

add_action( 'init', 'etc_elementor_init' );
function etc_elementor_init() {
	Plugin::get_instance();
}