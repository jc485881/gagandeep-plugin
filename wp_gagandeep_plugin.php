<html>
<body>
<!-- CSS -->
<style>
.myForm {
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 1em;
width: 50em;
padding: 1em;
border: 0px solid #ccc;
}

.myForm * {
box-sizing: border-box;
}

.myForm fieldset {
border: none;
padding: 0;
}

.myForm legend,
.myForm label {
padding: 0;
font-weight: bold;
}

.myForm label.choice {
font-size: 0.9em;
font-weight: normal;
}

.myForm label {
text-align: left;
display: block;
}

.myForm input[type="text"],
.myForm input[type="tel"],
.myForm input[type="email"],
.myForm input[type="datetime-local"],
.myForm select,
.myForm textarea {

width: 60%;
border: 1px solid #ccc;
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 1.5em;
padding: 0.3em;
}

.myForm textarea {
height: 100px;
}

.myForm input[type="radio"],
.myForm input[type="checkbox"] {
margin-left: 40%;
}

.myForm button {
padding: 1em;
border-radius: 0.5em;
background: #eee;
border: none;
font-weight: bold;
margin-left: 40%;
margin-top: 1.8em;
}

.myForm button:hover {
background: #ccc;
cursor: pointer;
}
</style>
</body>
</html>
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
	 taxi varchar(120) DEFAULT NULL,
	 extras varchar(120) DEFAULT NULL,
	 B_S_required int(10) DEFAULT NULL,
	 comments varchar(500) DEFAULT NULL,
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

function registration_form( $fname, $lname, $email, $taxi, $extras, $B_S_required, $comments ) {
		include_once PLUGIN_DIR_PATH."/style.css";
 
    echo '
    <form action="/agecare/wp-content/plugins/gagandeep_plugin/process.php" method="post">



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
		<fieldset>
			<label>Which taxi do you require?</label>
			<p><label class="choice"> <input type="radio" name="taxi" required value="car"> Car </label></p>
			<p><label class="choice"> <input type="radio" name="taxi" required value="van"> Van </label></p>
			
		</fieldset>
	</div>
	
	<div>
		<fieldset>
			<label>Extras</label>
			<p><label class="choice"> <input type="radio" name="extras" required value="car"> Baby Seat </label></p>
			<p><lable>NO. of Baby Seats</lable>
			<input type="text" name="B_S_required"></p>
			<p><label class="choice"> <input type="radio" name="extras" required value="van"> Wheelchair </label></p>
			<p><label class="choice"> <input type="radio" name="extras" required value="van"> Stock tip </label></p>
		
		</fieldset>
	</div>
     
    <div>
    <label>Any Other Comments/Information</label>
    <textarea name="comments"></textarea>
    </div>
    <input type="submit" name="submit" value="submit"/>
    </form>  
	';
}

function custom_registration_shortcode() {
	ob_start();
	registration_form( $fname, $lname, $email, $taxi, $extras,$B_S_required, $comments );
	return ob_get_clean();
	}
	add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );