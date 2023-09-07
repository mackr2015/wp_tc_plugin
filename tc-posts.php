<?php 
/*
* 
* @link              https://mackraicevic.com
* @since             1.0.0
* @package           TC_Posts
*
* @wordpress-plugin
* Plugin Name:       TC Recent Posts
* Plugin URI:        https://mackraicevic.com
* Description:       Tech Crunch plugin is created from the public API and diplays post list on the front end using shortcode. Visit the plugin Settigs page to get a Shortcode
* Version:           1.0.0
* Author:            Mack Raicevic
* Author URI:        https://mackraicevic.com
* License:           GPL-2.0+
* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain:       tc-posts
* Domain Path:       /languages
*/

// Prevent Direct Access
defined( 'ABSPATH' ) or die( 'Nothing interesting here.' );

if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
  require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


use Inc\Base\Activate;
use Inc\Base\Deactivate;
use Inc\Admin\Admin_Pages;

define( 'PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUGIN_NAME', plugin_basename( __FILE__ ) );


if( !class_exists( 'TC_Plugin' ) ) {

  class TC_Plugin {

  
    function register(){
      // add admin menu
      // attach scripts
      add_action( 'admin_menu', array( $this, 'add_admin_pages') );
  
      // setup setting links for our plugin
      // escape with double quotes and make variable read as string
      add_filter( "plugin_action_links_" . PLUGIN_NAME, array( $this, 'settings_link' ) );

     
      // shortcode Tech Crunch Posts display
      add_shortcode('tc-recent-posts', array( $this, 'shortcode_tc_init') );
    }


    function enqueue_style_front_end(){
      add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css_front_end' ) );
    }
  
    function settings_link( $links ){
      // add custom settings link
      $settings_link = '<a href="admin.php?page=tc_posts_plugin">Settings</a>';
      array_push( $links, $settings_link );
      return $links;
    }
  
    function add_admin_pages(){
      // initialize admin menu

      add_menu_page('TC Posts Plugin Settings', 'TC Posts Settings', 'manage_options', 'tc_posts_plugin', array( $this, 'admin_index' ), 'dashicons-book');

      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_css'));
      add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_script'));

    }
  
    function admin_index(){
      // include template
      include_once PLUGIN_PATH . '/templates/admin_page.php';
    }
   

    function shortcode_tc_init(){
      // ob_start();
      include PLUGIN_PATH . '/templates/shortcode_tc.php';
      // return ob_get_clean();
    }
    
  
    function activate(){
      Activate::activate();
    }
  
    
    function enqueue_css_front_end(){
      // front end only
      wp_enqueue_style( 'tcpluginstyle', PLUGIN_URL . 'assets/css/tcstyle.css' );
    }

    function enqueue_css(){
      // enqueue style css
      wp_enqueue_style( 'bootstrapcss', PLUGIN_URL . 'assets/css/bootstrap.min.css' );
      wp_enqueue_style( 'tcpluginstyle', PLUGIN_URL . 'assets/css/tcstyle.css' );
    }
    function enqueue_script(){
      // enqueue js scripts
      wp_enqueue_script( 'bootstrapjs', PLUGIN_URL . 'assets/js/bootstrap.min.js' );
      wp_enqueue_script( 'tcpluginscript', PLUGIN_URL . 'assets/js/tcmain.js' );
    }

  
  }


  // Initialize the TC_Plugin class
  $tc_plugin = new TC_Plugin;
  $tc_plugin->register();
  $tc_plugin->enqueue_style_front_end();

  // activation
  register_activation_hook( __FILE__, array( $tc_plugin, 'activate' ) );



  // deactivation
  register_deactivation_hook( __FILE__, array( 'Deactivate', 'deactivate' ) );

}




