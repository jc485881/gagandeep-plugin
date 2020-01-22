
<?php

/*
Plugin Name: Gagandeep_plugin
Plugin URI: http://wordpress.org/plugins/gagandeep_plugin/
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
    add_menu_page("gagandeep_pluginform",
	"gagandeep_plugin Form",
	"manage_options", 
	"gagandeep_pluginplugin",
	"gagandeep_plugin_admin_view",
	"dashicon-dashboard",3);
	}
add_action("admin_menu", "add_my_custom_menu");

function gagandeep_plugin_admin_view(){
	// give the message while click on plugin after installationn
    echo "Create a page & see the form over there";
}

function process(){
	// this is process page function
    include_once PLUGIN_DIR_PATH."/process.php";
}


//generating table
 function install() {
           global $wpdb;
		    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
           if (count($wpdb->get_var('SHOW TABLE LIKE "wp_custom_plugin"')) == 0 )
 
 $charset_collate = $wpdb->get_charset_collate();
 
 $sql = "CREATE TABLE 'my_table' (
     id mediumint(9) NOT NULL AUTO_INCREMENT,
     time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
     fname varchar(120) DEFAULT NULL,
	 lname varchar(120) DEFAULT NULL,
	 email varchar(120) DEFAULT NULL,
	 bio varchar(500) DEFAULT NULL,
     UNIQUE KEY id (id)
 ) $charset_collate;";
 

 dbDelta( $sql );
        }
    
 
    register_activation_hook(__FILE__, array( 'install' ) );

function deactivate_table() {
	  global $wpdb;
	  $wpdb->query("DROP table IF Exists wp_my_table");
   }
	register_deactivation_hook(__FILE__,"deactivate_table");

function registration_form( $fname, $lname, $email, $bio ) {
		include_once PLUGIN_DIR_PATH."/style.css";
 
    echo '
    <form action="/agecare/wp-content/plugins/gagandeep_plugin/process.php"	method="post">

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