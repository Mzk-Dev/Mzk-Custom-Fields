<?php
/**
 * Plugin Name: Mzk Custom Field
 * Description: Customize WordPress with powerful, professional and intuitive fields.
 * Plugin URI:  
 * Author URI:  https://github.com/Mzk-Dev
 * Author:      Max Cherenov
 * Version:     1.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit;




if ( ! class_exists( 'MCF' ) ) {

  class MCF {

    public function __construct() {
			// add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
			add_action( 'plugins_loaded', array( $this, 'constants' ));
      add_action( 'plugins_loaded', array( $this, 'includes' ) );
      add_action( 'plugins_loaded', array( $this, 'activator' ) );
			// add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'easy_slider_plugin_action_links' );
    }

    		/**
		 * Constants
		 *
		 * @since 1.0
		*/
		public function constants() {
			if ( !defined( 'CUSTOM_FIELDS_DIR' ) )
				define( 'CUSTOM_FIELDS_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

			if ( !defined( 'CUSTOM_FIELDS_URL' ) )
			    define( 'CUSTOM_FIELDS_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

			if ( ! defined( 'CUSTOM_FIELDS_VERSION' ) )
			    define( 'CUSTOM_FIELDS_VERSION', '1.0' );

			if ( ! defined( 'CUSTOM_FIELDS_INCLUDES' ) )
			    define( 'CUSTOM_FIELDS_INCLUDES', CUSTOM_FIELDS_DIR . trailingslashit( 'includes' ) );
		}

     /**
		* Loads the initial files needed by the plugin.
		*
		* @since 1.0
		*/
		public function includes() {

      require_once( CUSTOM_FIELDS_INCLUDES . 'save-metabox.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'input.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'textarea.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'image.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'wysiwyg.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'color.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'video.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'slider.php' );
	  require_once( CUSTOM_FIELDS_INCLUDES . 'helpers.php' );
		
    }

    public function activator(){
      register_activation_hook( __FILE__, array($this, 'mzk_custom_fields_activate') );
      register_deactivation_hook( __FILE__, array($this, 'mzk_custom_fields_deactivate') );
    }


    public function mzk_custom_fields_activate() {
    
    }


    public function mzk_custom_fields_deactivate() {
      // require_once(__DIR__ . '/includes/DB.php');

      // global $wpdb;
      
      
    }
  }

  $mzk_custom_fields = new MCF();

  register_activation_hook( __FILE__, array($mzk_custom_fields, 'mzk_custom_fields_activate') );
  register_deactivation_hook( __FILE__, array($mzk_custom_fields, 'mzk_custom_fields_deactivate') );
};

function mzk_admin_styles() {
	wp_enqueue_style( 'mzk-style', plugins_url( 'mzk-custom-fields/css/easy-slider.css', dirname(__FILE__) ) );
}
add_action('admin_enqueue_scripts', 'mzk_admin_styles');