<?php
$conn = mysqli_connect('localhost','root','root','user_details');
if($conn){
	echo "Connection established";
}else{
	die('Could not Connect MySql Server:' .mysql_error());
}


?>