		<?php
function Connect()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "agecare";
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname 			);
	return $conn	;
}

?>

<?php

$conn = Connect();
if(isset($_POST['submit'])){
$fname = $conn->real_escape_string($_POST['fname']);
$lname = $conn->real_escape_string($_POST['lname']);
$email = $conn->real_escape_string($_POST['email']);
$taxi = $conn->real_escape_string($_POST['taxi']);
$extras = $conn->real_escape_string($_POST['extras']);
$B_S_required  = $conn->real_escape_string($_POST['B_S_required']);
$dplace = $conn->real_escape_string($_POST['dplace']);
$comments = $conn->real_escape_string($_POST['comments']); 

$query ="INSERT into wp_my_table(fname,lname,email,taxi,extras,B_S_required, dplace, comments) VALUES ('$fname','$lname','$email','$taxi','$extras','$B_S_required ','dplace','$comments')";

echo $query;
$success = $conn->query($query);

if(!$success) {
	die("Couldn't enter data:".$conn->error);
}

echo "Thank You for Contacting us <b>";

$conn->close();
}
?>
	