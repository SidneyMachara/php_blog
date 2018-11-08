<?php
session_start();

$_SESSION['group'] = FALSE;
session_destroy();
header('location:login.php');
 ?>
