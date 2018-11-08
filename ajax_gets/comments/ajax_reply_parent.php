<?php
include("../../includes/db_connect.php");
include("../../includes/fomater.php");

if(isset($_POST['parent_ID']) && isset($_POST['comment'])  && isset($_POST['user'])){

    $comment = $_POST['comment'];
    $parent_ID = $_POST['parent_ID'];
    $user = "Anonomuos";
    $category = $_POST['category'];
    // $singleID = $_POST['singleID'];

    $query = "INSERT INTO comments (comment,user,parent_comment,category) VALUES ('$comment','$user','$parent_ID','$category')";
    mysqli_query($conn,$query);


}



 ?>


           <!-- reply -->

             <!-- ==>get the replies of a PARENT COMENT -->
             <?php
                 $parent_ID = $parent_ID;
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
               <input type="hidden" name="parent_ID" value="<?php $parent_ID; ?>" id="<?php echo 'parent_ID'.$parent_ID; ?>">

               <textarea name="commentR" rows="4" class="textarea" required id="<?php echo 'commentR'.$parent_ID; ?>"></textarea><br>

               <input type="submit" name="<?php echo $parent_ID; ?>" value="Reply" class="reply_parent_btn" id="<?php echo 'reply_parent_btn'.$parent_ID; ?>">
             <!-- </form> -->
             <!--============================== -->
