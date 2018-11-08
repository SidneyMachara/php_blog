<?php
include("includes/head.php");
include("includes/admin_navbar.php");

if( $_SESSION['group'] != 'ADMIN'){
  header('location:login.php');
}

$msg_updated_post="";
if(isset($_POST['Publish'])){

  //the path to store Image
  $target = "../post_images/".basename($_FILES['image']['name']);
  $image = $_FILES['image']['name'];

  $post_title = $_POST['post_title'];
  $post_body = $_POST['post_body'];
  $Category = $_POST['Category'];
  $Author = $_POST['Author'];



  // $query = "INSERT INTO posts (category,title,body,author,date_published)
  //           VALUES ('$Category','$post_title','$post_body','$Author')";
  $query = "INSERT INTO posts (category,title,body,author,image)
           VALUES ('$Category','$post_title','$post_body','$Author','$image')";
  mysqli_query($conn, $query);

echo  '<script type="text/javascript">';
echo  '$(document).ready(function(){ ';
echo  '$(".msg_updated_post").css({display:"block"}) ';
echo  '});' ;
echo   '</script>'  ;


  $msg_updated_post = "Post has been added";
  //move image into folder images
  if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
      $msg= "sucesfull";
    }else{
      $msg= "there was a problem";
    }

}



 ?>
<!DOCTYPE html>
<html>


  <body>

    <div class="dashboard_addpost">

      <h2>Hello <?php echo $_SESSION['username']; ?></h2>

      <div class="msg_updated_post"> <?php echo $msg_updated_post; ?></div>


      <form class="" action="addPost.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="size" value="1000000">

      <p>Post Title</p>
      <input type="text" name="post_title" value="" required>

      <p>Post Body</p>
      <textarea name="post_body" rows="4" class="input_select" placeholder="Thank you David Sidney Machara...." required></textarea>

      <p>Category</p>
      <select class="input_select" name="Category" required>
        <?php
          $query = "SELECT * FROM category";
          $result = mysqli_query($conn,$query);

          while($row = mysqli_fetch_assoc($result)) {
         ?>
         <option value="<?php echo $row['id']; ?>" ><?php echo $row['category_name']; ?></option >

           <?php } ?>
      </select>

      <p>Author</p>
      <input type="text" name="Author" value="" required>


      <div class="image_upload_container">
        <label for="image_upload_btn" class="image_upload_label">Upload Image</label>
        <input type="file" name="image" required id="image_upload_btn"> <br>

      </div>
      <input type="submit" name="Publish" value="Publish">
      <input type="submit" name="Delete" value="Delete" class="delete">
      </form>

    </div>





  </body>
  <?php include("../includes/footer.php"); ?>
</html>
