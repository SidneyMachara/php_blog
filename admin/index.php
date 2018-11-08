<?php
include("includes/head.php"); //also incluseds db_connect.php and session start


include("includes/admin_navbar.php");
include("../includes/fomater.php");
//the code for checking if the user is loged in is in head.php
 ?>


<!DOCTYPE html>
<html>


  <body>


    <div class="dashboard">
      <h2>Hello <?php echo $_SESSION['username']; ?></h2>

      <div class="dash_container">

        <!-- category table -->



          <table class="category_table">
            <tr>
              <th>categoryID#</th>
              <th>Category</th>
              <th></th>

            </tr>
                <?php
                  $query = "SELECT * FROM category";
                  $result = mysqli_query($conn,$query);

                  while($row = mysqli_fetch_assoc($result)) {
                 ?>

                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><a href=""><?php echo $row['category_name']; ?></a></td>
                      <!-- deleting category is implemented at the bottom using ajax -->
                      <td><input type="submit" class="delete_category"  value="X" id="<?php echo $row['id']; ?>" ></td>
                    </tr>
                <?php } ?>

          </table>

        <!-- post table -->

        <table class="post_table">
          <tr>
            <th>PostID#</th>
            <th>Post Title</th>
            <th>Category</th>
            <th>Author</th>
            <th>Date</th>
            <th></th>
          </tr>

          <?php
            $query = "SELECT posts.*, category.category_name
                      FROM posts
                      INNER JOIN category
                      ON posts.category = category.id";
            $result = mysqli_query($conn,$query);

            while($row = mysqli_fetch_assoc($result)) {
           ?>

              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><a href="addPost.php?postID='<?php echo urlencode($row['id']); ?>'"><?php echo $row['title']; ?></a></td>
                <td><?php echo $row['category_name']; ?></td>
                <td><?php echo $row['author']; ?></td>
                <td><?php echo format_date($row['date_published']); ?></td>
                <td><input type="submit" class="delete_post" value="X" id="<?php echo $row['id']; ?>" ></td>
              </tr>

              <?php } ?>


        </table>

    </div>
  </div>

  </body>

  <?php include("../includes/footer.php"); ?>


<!-- delete category and post-->
  <script type="text/javascript">

    $(document).ready(function(){

                // this function was made so that when u delete a category it
                // can also call this function to delete related posts
                function deletePost(post_id,category_id){
                  $.ajax({
                    type:"POST",
                    url:"ajax_gets_admin/delete_post.php",
                    cache:false,
                    data:{
                      'post_id':post_id,
                      'category_id':category_id //this is for when th fuction is called by delete category
                    },
                    success:function(data){
                        $('.post_table').html(data); //replace old category table with updated table
                    }
                  });
               }


               // delete post
               $(document).on('click','.delete_post',function(){ //when u click item of class .delete_category
                 var post_id = $(this).attr("id"); //get the id of category to be deleted
                 var category_id = "";

                deletePost(post_id,category_id);

               });
               //-------------------------


        //delete category
        $(document).on('click','.delete_category',function(){ //when u click item of class .delete_category
          var category_id = $(this).attr("id"); //get the id of category to be deleted
          var post_id = "";

          $.ajax({
            type:"POST",
            url:"ajax_gets_admin/delete_category.php",
            cache:false,
            data:{
              'category_id':category_id
            },
            success:function(data){
                $('.category_table').html(data); //replace old category table with updated table
            }
          });

            deletePost(post_id,category_id);
        });
        //---------------------


    });

  </script>

</html>
