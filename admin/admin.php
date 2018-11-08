<?php
include("includes/head.php"); //has db_connect.php and session
include("includes/admin_navbar.php");
if( $_SESSION['group'] != 'ADMIN'){
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html>

  <body>

    <div class="dashboard_admin">

      <h2>Hello <?php echo $_SESSION['username']; ?></h2>

      <!-- <form class="" action="" method="post"> -->

      <p>Current Password</p>
      <input type="password" name="current_pwd" value="" required placeholder="******" id="current_pwd">

      <p>New Password</p>
      <input type="password" name="new_pwd" value="" required placeholder="******" id="new_pwd">

      <p>Confirm Password</p>
      <input type="password" name="confirm_pwd" value="" required placeholder="******" id="confirm_pwd">

      <input type="submit" name="change" value="Change" class="change_pwd">

      <!-- </form> -->

    </div>





  </body>
  <?php include("../includes/footer.php"); ?>
</html>

<script type="text/javascript">

$(document).ready(function(){
  $(document).on('click','.change_pwd',function(){
    var current_pwd = $('#current_pwd').val();
    var new_pwd = $('#new_pwd').val();
    var confirm_pwd = $('#confirm_pwd').val();
    var username =  "<?php echo $_SESSION['username']; ?>";

      $.ajax({
        type:"POST",
        cache:false,
        url:"ajax_gets_admin/change_password.php",
        data:{
          current_pwd:current_pwd,
          new_pwd:new_pwd,
          confirm_pwd:confirm_pwd,
          username:username

        },
        success:function(data){
          $('.dashboard_admin').html(data);
        }

      });
  });
});

</script>
