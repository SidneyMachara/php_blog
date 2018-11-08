<?php
include("includes/head.php");
include("includes/admin_navbar.php");

if( $_SESSION['group'] != 'ADMIN'){
  header('location:login.php');
}




// if(isset($_POST['add'])){
//   $category = $_POST['category'];
//
//   $query = "INSERT INTO category (category_name) VALUES ('$category')";
//   mysqli_query($conn, $query);
// }

if(isset($_POST['delete'])){
  ?>
  <script type="text/javascript">
    alert("WHOES YOUR DADDY (^.^) ...doesnt work..i put it just couse i can!!!!!!!!");
  </script>
  <?php
}



 ?>


<!DOCTYPE html>
<html>

  <body>

<div class="dashboard_addcategory">
    <h2>Hello <?php echo $_SESSION['username']; ?></h2>



      <p>Category Name</p>
      <input type="text" name="category" value="" required id="category" autofocus>
      <input type="submit" name="add" value="Add" class="add_category_">
      <input type="submit" name="delete" value="Delete" class="delete">




</div>


  </body>
    <?php include("../includes/footer.php"); ?>
</html>

<script type="text/javascript">
  $(document).ready(function(){

    $(document).on('click','.add_category_',function(){
      var category = $('#category').val();

      $.ajax({
        type:"POST",
        url:"ajax_gets_admin/ajax_add_category.php",
        data:{
          'category':category
        },
        success:function(data){
          $('.dashboard_addcategory').html(data);

        }


      });
    });

  });

</script>
