<!--<html>
<body>
 CSS 
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
</html>-->

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Contact Form Script With Validation - reusable form</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="form.css" >
        <script src="form.js"></script>
    </head>
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
	 dplace varchar(120) DEFAULT NULL,
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

function registration_form( $fname, $lname, $email, $taxi, $extras, $B_S_required, $dplace, $comments ) {
		
 
    echo '
   <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Contact Us</h2> 
                    <p> Send us your message and we will get back to you as soon as possible </p>
                    <form role="form" method="post" id="reused_form">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name"> First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="fname" maxlength="50">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="name"> Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lname" maxlength="50">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="email"> Email:</label>
                                <input type="text" class="form-control" id="email" name="email" maxlength="50">
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="number"> Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required maxlength="10">
                            </div>
							<div class="col-sm-4 form-group">
							<fieldset>
                                <label for="choice"> Which taxi do you require?</label>
                                
								<p><label class="choice"> <input type="radio" name="taxi" required value="car"> Car </label></p>
			<p><label class="choice"> <input type="radio" name="taxi" required value="van"> Van </label></p>
			<p><label class="choice"> <input type="radio" name="taxi" required value="van"> Van </label></p>
								</fieldset>
                            </div>
							
							 
							<div class="col-sm-4 form-group">
							<fieldset>
                                <label for="choice"> Extras</label>
                                <p><label class="choice"> <input type="radio" name="extras" required value="Baby Seat"> Baby Seat 
			
			<p><label class="choice"> <input type="radio" name="extras" required value="Wheelchair"> Wheelchair </label></p>
			<p><label class="choice"> <input type="radio" name="extras" required value="Stock tip"> Stock tip </label></p>
								</fieldset>
                            </div>
							
							
							
							
							
							<div class="col-sm-4 form-group">
							</label><label>NO. of Baby Seats</label>
			<input style="width:100px; height:40px;" type="number" name="B_S_required" value="" list="nseats">
			<datalist id="nseats">
			<option value="1">
			<option value="2">
			<option value="3">
			</datalist></p>
			</div></div>
			
			
			<div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="dplace"> Pickup Address:</label>
                                <input type="text" class="form-control" id="pplace" name="pplace" maxlength="50" required>
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="dplace">Dropoff Address:</label><datalist id="destinations">
<option value="Airport">
<option value="Beach">
<option value="Fred Flinstones House">


                                <input type="text" class="form-control" id="dplace" name="dplace" maxlength="50" required></datalist>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="name"> Message:</label>
                                <textarea class="form-control" type="textarea" id="message" name="message" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Post It! </button>
                            </div>
                        </div>
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                </div>
            </div>
        </div>	';
}

function custom_registration_shortcode() {
	ob_start();
	registration_form( $fname, $lname, $email, $taxi, $extras,$B_S_required, $dplace, $comments );
	return ob_get_clean();
	}
	add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );