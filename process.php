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
$phone = $conn->real_escape_string($_POST['phone']);
$email = $conn->real_escape_string($_POST['email']);
$taxi = $conn->real_escape_string($_POST['taxi']);
$extras = $conn->real_escape_string($_POST['extras']);
$pplace = $conn->real_escape_string($_POST['pplace']);
$dpalce = $conn->real_escape_string($_POST['dpalce']);
$comments = $conn->real_escape_string($_POST['comments']); 

$query ="INSERT into wp_my_table(fname,phone,email,taxi,extras,pplace,dpalce,comments) VALUES ('$fname','$phone','$email','$taxi,'$extras','$pplace','$dpalce','$comments')";

echo $query;
$success = $conn->query($query);

if(!$success) {
	die("Couldn't enter data:".$conn->error);
}

echo "Thank You for Contacting us <b>";

$conn->close();
}
?>
	