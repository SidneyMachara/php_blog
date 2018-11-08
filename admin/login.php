<?php
include("../includes/db_connect.php");

$_SESSION['group'] = '';

$errormsg = "";
if(isset($_GET['errormsg'])){
  $errormsg = $_GET['errormsg'];
}


if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['pwd'];


  $query = "SELECT * FROM user WHERE username = '$username'";
  $result = mysqli_query($conn,$query);

    if($result->num_rows == 0){

        header("location:login.php?errormsg='no user'");
    }else{

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password,$row['password'])){
        // if($row['password'] == $password){

          $_SESSION['username'] = $row['username'];
          $_SESSION['group'] = 'ADMIN';
          // header("location:login.php?errormsg = 'in'");

          header("location:index.php");
        }else{
            header("location:login.php?errormsg='wrong password'");

        }

    }


}



 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width-device-width, initial-scale=1">
    <!-- temp  choose links to use later-->
    <script src="../css/jquery.js"></script>
      <link rel="stylesheet"  href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/admin_Styles.css">
  </head>
  <body class="login_body">



<div class="login_container">

  <span class="errormsg">  <?php  echo $errormsg; ?></span>

  <h3>Login</h3>

  <form class="" action="login.php" method="post">
    <p>Username</p>
    <input type="text" name="username" value="" placeholder="Enter Username" autofocus>
    <p>Password</p>
    <input type="password" name="pwd" value="" placeholder="***************">
    <input type="submit" name="login" value="Submit">
  </form>

</div>





  </body>
</html>
