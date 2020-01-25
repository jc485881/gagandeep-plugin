

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
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
	 phone int(10) DEFAULT NULL,
	 taxi varchar(120) DEFAULT NULL,
	 extras varchar(120) DEFAULT NULL,
	 B_S_required int(10) DEFAULT NULL,
	 st_no int(100) DEFAULT NULL,
	 st_name varchar(120) DEFAULT NULL,
	 suburb varchar (120) DEFAULT NULL,
	 dplace varchar(120) DEFAULT NULL,
	 ptype varchar(120) DEFAULT NULL,
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

function registration_form( $fname, $lname, $email, $phone, $taxi, $extras, $B_S_required, $st_no, $st_name, $suburb, $dplace, $ptype, $comments ) {
		
 
    echo '
	<form action="/agecare/wp-content/plugins/gagandeep_plugin/process.php" method="post">
   <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>Online Cab Booking Form</h1> 
                    <p> Send us your message with the details and we will get back to you as soon as possible </p>
                    
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="name"> First Name:</label>
                                <input type="text" class="form-control" id="firstname" name="fname" maxlength="50" placeholder="john" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="name"> Last Name:</label>
                                <input type="text" class="form-control" id="lastname" name="lname" placeholder="smith" maxlength="50" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label for="email"> Email:</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="johnsmith@gmail.com" maxlength="50" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="number"> Phone:</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="0"  maxlength="10" required>
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
							</label><label>NO. of Baby Seats if Required</label>
			<input style="width:100px; height:40px;" type="number" name="B_S_required" value="" list="nseats" placeholder="MAX:3">
			<datalist id="nseats">
			<option value="1">
			<option value="2">
			<option value="3">
			</datalist></p>
			</div></div>
			
			
			<div class="row">
			<label for="pplace">        Pickup Address:</label>
                            <div class="col-sm-4 form-group">
                                
                                <input type="number" class="form-control" id="st_no" name="st_no" maxlength="50" placeholder="Street No." required>
                            </div>
							<div class="col-sm-4 form-group">
							<input type="text" class="form-control" id="st_name" name="st_name" maxlength="50" placeholder="Street Name" required>
							
							</div>
							<div class="col-sm-4 form-group">
							<input type="text" class="form-control" id="suburb" name="suburb" maxlength="50" placeholder="Suburb" required>
							</div>
                        </div>
						
						<div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="dplace">Dropoff Address:</label>
								 <input type="text" class="form-control" id="dplace" name="dplace" maxlength="50" placeholder="Please Enter Your Full Address" required><datalist id="destinations">
<option value="Airport">
<option value="Beach">
<option value="Fred Flinstones House">


                               </datalist>
                            </div>
                        </div>
						
							<div class="row">
                            <div class="col-sm-12 form-group">
                               <fieldset>
                                <label for="choice"> Payment Type</label>
                                
								<p><label class="choice"> <input type="radio" name="ptype" required value="cash"> Cash                 <input type="radio" name="ptype" required value="card"> Card                 
								<input type="radio" name="ptype
								" required value="vouchers">Vouchers</label></p>
		
								</fieldset>
                            </div>
                        </div>
						
                        
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="name"> Message:</label>
                                <textarea class="form-control" type="textarea" id="message" name="comments" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                 <input type="submit" name="submit" value="submit"/>
                            </div>
                        </div>
					</div>
				<div>
			</div>
						</form>
                    
                   	';
		
}

function custom_registration_shortcode() {
	ob_start();
	registration_form( $fname, $lname, $email, $phone, $taxi, $extras, $B_S_required, $st_no, $st_name, $suburb, $dplace, $ptype, $comments );
	return ob_get_clean();
	}
	add_shortcode( 'cr_custom_registration', 'custom_registration_shortcode' );