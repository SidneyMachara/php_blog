<?php
include("../../includes/db_connect.php");
include("../../includes/fomater.php");

if(isset($_POST['parent_comment_textarea']) && isset($_POST['parent_comment_as'])  && isset($_POST['singleID'])){

  $comment = $_POST['parent_comment_textarea'];
  $user = $_POST['parent_comment_as'];
  $singleID = $_POST['singleID'];
  $category = $_POST['category'];

  $query = "INSERT INTO comments (comment,user,post_id,category) VALUES ('$comment','$user',$singleID,$category)";
  mysqli_query($conn,$query);
}



 ?>

 <div class="comments_inner">
   <h3>Comments</h3>

<?php
   $query = "SELECT * FROM comments WHERE parent_comment = 0 and post_id = $singleID ";
   $results = mysqli_query($conn,$query);

   if($results->num_rows <=0){
     ?>
     <p class="no_comments">No comments yet!! <br> BE the FIRST to comment (*.*)</p>
     <?php
   }else{

       while($row = mysqli_fetch_assoc($results)){
         ?>

         <div class="parent_comment">

           <div class="c_info">
             <h4><?php echo $row['user']; ?></h4>
             <h5><?php echo format_date($row['comment_date']); ?></h5>
             <p><?php  echo $row['comment'] ?></p>
           </div>
           <!-- <span><a href="return false">Replies</a></span> -->

           <!--  id is used to create part of reply_box id down in the child_comments-->
           <span><input type="button" name="" value="Replies" class="show_reply_box_btn " id="<?php echo $row['id']; ?>"></span>


         </div>

         <div class="child_comments">
           <!-- reply -->
           <div class="reply_box" id="<?php echo 'reply_box'.$row['id']; ?>">
             <!-- ==>get the replies of a PARENT COMENT -->
             <?php
                 $parent_ID = $row['id'];
                 $query2 = "SELECT * FROM comments WHERE parent_comment = $parent_ID";
                 $results2 = mysqli_query($conn,$query2);

             while($row2 = mysqli_fetch_assoc($results2)){
              ?>
                  <div class="c_info">
                    <h4><?php echo $row2['user']; ?></h4>
                    <h5><?php echo format_date($row2['comment_date']); ?></h5>
                    <p><?php  echo $row2['comment'] ?></p>
                  </div>
              <?php
             }
               ?>
           <!-- end parent replies======================> -->
           <!-- reply on parent -->
           <!-- <form class="" action="" method="post"> -->
           <input type="hidden" name="parent_ID" value="<?php echo $row['id']; ?>" id="<?php echo 'parent_ID'.$row['id']; ?>">

           <textarea name="commentR" rows="4" class="textarea" required id="<?php echo 'commentR'.$row['id']; ?>"></textarea><br>

           <input type="submit" name="<?php echo $row['id']; ?>" value="Reply" class="reply_parent_btn" id="<?php echo 'reply_parent_btn'.$row['id']; ?>">
           <!-- </form> -->
             <!--============================== -->
           </div>

         </div>

         <hr>
         <?php
       }//else
   } //if

?>


 </div>



 <div class="make_comment_container">

   <!-- <form> -->
     <textarea name="comment" rows="4" class="textarea" required id="parent_comment_textarea"></textarea>
     <br>

     <span>Comment As:</span>
     <input type="text" name="comment_as" value="" required id="parent_comment_as">


     <input type="submit" name="Comment_btn" value="Comment" id="Comment_btn">

   <!-- </form> -->

 </div>
