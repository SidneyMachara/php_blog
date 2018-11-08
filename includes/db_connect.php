<?php
session_start();
$host = 'localhost';
$user = 'id4747154_peace_society_blog';
$pass = 'd@#74401600';
$db = 'id4747154_peace_society_blog';
$conn = mysqli_connect($host,$user,$pass,$db) or die($conn->error);

//-----------------
$_SESSION['already_liked'] = 0;


?>
