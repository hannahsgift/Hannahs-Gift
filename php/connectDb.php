<?php 
$link = mysqli_connect('localhost','root','','game'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}
function clean($var){
	return  htmlspecialchars(trim(strip_tags(stripslashes($var))));
}
?> 