
<?php
include("../../includes/db_connect.php");


if(isset($_POST['current_pwd']) && isset($_POST['new_pwd']) && isset($_POST['confirm_pwd'])){

$current_pwd = $_POST['current_pwd'];
$new_pwd = $_POST['new_pwd'];
$confirm_pwd = $_POST['confirm_pwd'];
$username = $_POST['username'];


$query = "SELECT * FROM user WHERE username = '$username'";
$user_data = mysqli_query($conn,$query);




while($row = mysqli_fetch_assoc($user_data)) {
  $real_pwd = $row['password'];

  if(password_verify($current_pwd,$real_pwd)){
    if($new_pwd == $confirm_pwd){ // allowing chage
         $new_pwd = password_hash($new_pwd,PASSWORD_DEFAULT);
         $query = "UPDATE user SET password = '$new_pwd' WHERE username = '$username' ";
         mysqli_query($conn,$query);
        ?>

        <h2>Hello <?php echo $_SESSION['username']; ?></h2>

        <div class="msg_updated">Password changed Successfuly</div>

        <!-- <form class="" action="" method="post"> -->

        <p>Current Password</p>
        <input type="password" name="current_pwd" value="" required placeholder="******" id="current_pwd">

        <p>New Password</p>
        <input type="password" name="new_pwd" value="" required placeholder="******" id="new_pwd">

        <p>Confirm Password</p>
        <input type="password" name="confirm_pwd" value="" required placeholder="******" id="confirm_pwd">

        <input type="submit" name="change" value="Change" class="change_pwd">

        <!-- </form> -->

    <?php
  }else{ //New and Confirm Password do Not match
      ?>
      <h2>Hello <?php echo $_SESSION['username']; ?></h2>

      <div class="msg_updated error_msg">New and Confirm Password do Not match</div>

      <!-- <form class="" action="" method="post"> -->

      <p>Current Password</p>
      <input type="password" name="current_pwd" value="" required placeholder="******" id="current_pwd">

      <p>New Password</p>
      <input type="password" name="new_pwd" value="" required placeholder="******" id="new_pwd">

      <p>Confirm Password</p>
      <input type="password" name="confirm_pwd" value="" required placeholder="******" id="confirm_pwd">

      <input type="submit" name="change" value="Change" class="change_pwd">

      <!-- </form> -->
      <?php
    }
  }else{ //Bad Password
    ?>

    <h2>Hello <?php echo $_SESSION['username']; ?></h2>

    <div class="msg_updated error_msg"> Bad Password</div>

    <!-- <form class="" action="" method="post"> -->

    <p>Current Password</p>
    <input type="password" name="current_pwd" value="" required placeholder="******" id="current_pwd">

    <p>New Password</p>
    <input type="password" name="new_pwd" value="" required placeholder="******" id="new_pwd">

    <p>Confirm Password</p>
    <input type="password" name="confirm_pwd" value="" required placeholder="******" id="confirm_pwd">

    <input type="submit" name="change" value="Change" class="change_pwd">

    <!-- </form> -->

    <?php
  }
}


}

?>
