<?php include("includes/head.php");
include("includes/navbar.php");
include("includes/fomater.php");

$singleID = $_GET['singleID'];
$category = "";

// to avoid invalid url access
if(empty(isset($_GET['singleID']))){
  header("location:index.php");
}

?>
<!DOCTYPE html>
<html>
  <body>

      <div class="blog_content ">

          <div class="left_container">

            <?php
              $query = "SELECT * FROM posts WHERE id = $singleID";
              $result = mysqli_query($conn,$query);

              // to avoid invalid url access
              if($result->num_rows <= 0){
                header("location:index.php");
              }

              while($row = mysqli_fetch_assoc($result)) {
                $category = $row['category']; //value is used in deleting post comments
                $likes = $row['likes'];
             ?>

              <div class="post_box_in_single_post">
                <center>
                <img src="post_images/<?php echo $row['image'] ?>" alt="" class="post_img">
              </center>
                  <h3><?php echo $row['title']; ?></h3>
                  <hr>
                    <p class="date_author"><?php echo format_date($row['date_published']); echo" ....... by ". $row['author'];?></p>
                  <!-- <div class="post"> -->
                  <p>
                      <?php echo $row['body']; ?>
                  </p>
                <!-- </div> -->

              </div>
              <?php }

                  include("includes/social_media_share.php");
                  include("includes/comments.php");
              ?>




          </div>


            <!-- about and popular -->
            <!-- right_bar -->
            <?php include("includes/right_bar.php"); ?>


      </div>





      <!-- ============================ -->
      <a href="#" onclick="return false;"  class="backToTop" ><center>&#8686; </center></a>
      <?php   include("includes/auto_scroll_to.php"); ?>
      <script type="text/javascript">
            $(document).ready(function(){
              $(document).on('mousedown','.backToTop',function(){
                auto_scroll_TOP('top'); //top is id of a div in navbar.php
              });
            });
      </script>
      <!-- ================================ -->




  </body>
  <?php include("includes/subscribe.php"); ?>
  <?php include("includes/footer.php"); ?>
</html>

<script type="text/javascript">
  $(document).ready(function(){
    var already_liked = <?php echo $_SESSION['already_liked']; ?>;
    // when you clike like button
    $(document).on('click','.like',function(){
      var singleID = <?php echo $singleID; ?>;

      if(already_liked == 0){
        $.ajax({

          type:"post",
          url:"ajax_gets/like_post.php",
          cache:false,
          data:{
            singleID:singleID
          },
          success:function(data){
            $('.num_likes').html(data);
          }
        });



      }//end if
      <?php $_SESSION['already_liked'] = 1; ?>
      already_liked = <?php echo $_SESSION['already_liked']; ?>;//this variable originates in db_connect.php
    });
    //============================
  });
</script>
