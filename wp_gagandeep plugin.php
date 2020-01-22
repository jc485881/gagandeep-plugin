
<?php

/*
Plugin Name: Gagandeep plugin
Plugin URI: http://wordpress.org/plugins/gaganplugin/
Description:  This is my first Plugin in wordpress
Author: Gagandeep
Version: 1.0
Author URI: http://www.facebook.com
*/

// constants

define("PLUGIN_DIR_PATH",plugin_dir_path(__FILE__));
define("PLUGIN_URL",plugins_url());
define ("PLUGIN_VERSION","1.0");





function add_my_custom_menu() {
    add_menu_page("gaganpluginform",
	"gaganplugin Form",
	"manage_options", 
	"gaganpluginplugin",
	"gaganplugin_admin_view",
	"dashicon-dashboard",3);
	}
add_action("admin_menu", "add_my_custom_menu");

function gaganplugin_admin_view(){
	// give the message while click on plugin after installationn
    echo "Create a page & see the form over there";
}

function processpage(){
	// this is process page function
    include_once PLUGIN_DIR_PATH."/process.php";
}



class MyPlugin {
        static function install() {
           global $wpdb;
           $table_name = $wpdb->prefix . 'my_table';
 
 $charset_collate = $wpdb->get_charset_collate();
 
 $sql = "CREATE TABLE $table_name (
     id mediumint(9) NOT NULL AUTO_INCREMENT,
     time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
     fname varchar(120) DEFAULT NULL,
	 lname varchar(120) DEFAULT NULL,
	 email varchar(120) DEFAULT NULL,
	 bio varchar(500) DEFAULT NULL,
     UNIQUE KEY id (id)
 ) $charset_collate;";
 
 require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
 dbDelta( $sql );
        }
    }
 
    register_activation_hook(__FILE__, array( 'MyPlugin', 'install' ) );

function deactivate_table() {
	  global $wpdb;
	  $wpdb->query("DROP table IF Exists wp_my_table");
   }
	register_deactivation_hook(__FILE__,"deactivate_table");

function registration_form( $fname, $lname, $email, $bio ) {
		include_once PLUGIN_DIR_PATH."/style.css";
 
    echo '
    <form action="/mentalwellbeing/wp-content/plugins/gaganpluginform/process.php" method="post">

    <div>
    <label>First Name</label>
    <input type="text" name="fname" value="">
    </div>
     
    <div>
    <label>Last Name</label>
    <input type="text" name="lname" value="">
    </div>
     
    <div>
    <label>Email</label>
    <input type="email" name="email" value="">
    </div>
     
    <div>
    <label>About</label>
    <textarea name="bio"></textarea>
    </div>
    <input type="submit" name="submit" value="submit"/>
    </form>
    ';
}

function custom_registration_shortcode() {
	ob_start();
	registration_form( $fname, $lname, $email, $bio );
	return ob_get_clean();
	}
	add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );