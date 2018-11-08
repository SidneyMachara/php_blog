<?php
include("../includes/db_connect.php");
if(!isset($_SESSION['group'])){
  header('location:login.php');
}
 ?>

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="viewport" content="width-device-width, initial-scale=1">
  <!-- temp  choose links to use later-->
  <script src="../css/jquery.js"></script>
    <link rel="stylesheet"  href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet"  href="css/admin_Styles.css">


</head>
