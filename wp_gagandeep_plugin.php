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
    <form class="myForm" method="get" enctype="application/x-www-form-urlencoded" action="/html/codes/html_form_handler.cfm">

<p>
<label>Name
<input type="text" name="customer_name" required>
</label> 
</p>

<p>
<label>Phone 
<input type="tel" name="phone_number">
</label>
</p>

<p>
<label>Email 
<input type="email" name="email_address">
</label>
</p>

<fieldset>
<legend>Which taxi do you require?</legend>
<p><label class="choice"> <input type="radio" name="taxi" required value="car"> Car </label></p>
<p><label class="choice"> <input type="radio" name="taxi" required value="van"> Van </label></p>
<p><label class="choice"> <input type="radio" name="taxi" required value="tuktuk"> Tuk Tuk </label></p>
</fieldset>

<fieldset>
<legend>Extras</legend>
<p><label class="choice"> <input type="checkbox" name="extras" value="baby"> Baby Seat </label></p>
<p><label class="choice"> <input type="checkbox" name="extras" value="wheelchair"> Wheelchair Access </label></p>
<p><label class="choice"> <input type="checkbox" name="extras" value="tip"> Stock Tip </label></p>
</fieldset>

<p>
<label>Pickup Date/Time
<input type="datetime-local" name="pickup_time" required>
</label>
</p>
	


<p>
<label>Dropoff Place
<input type="text" name="dropoff_place" required list="destinations">
</label>

<datalist id="destinations">
<option value="Airport">
<option value="Beach">
<option value="Fred Flinstones House">
</datalist>
</p>

<p>
<label>Special Instructions
<textarea name="comments" maxlength="500"></textarea>
</label>
</p>

<p><button>Submit Booking</button></p>

</form>
    ';
}

function custom_registration_shortcode() {
	ob_start();
	registration_form( $fname, $lname, $email, $bio );
	return ob_get_clean();
	}
	add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );