
<div class="comment_container">

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
              <!-- ==>get the replies of a PARENT COMmENT -->
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
               <!-- //parent id to b add at the end of other id's "make em unique" -->
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
      <textarea name="comment" rows="4" class="textarea" required id="parent_comment_textarea" placeholder="Comment here..."></textarea>
      <!-- <div class="">
        <img src="emoj/Relieved_Emoji.png" alt="" class="emoj" id="k">
      </div> -->
      <br>

      <span>Comment As:</span>
      <input type="text" name="comment_as" value="" required id="parent_comment_as">


      <input type="submit" name="Comment_btn" value="Comment" id="Comment_btn">

    <!-- </form> -->

  </div>

</div>
<script type="text/javascript">
  $(document).ready(function(){
    // var existing_text = $('#parent_comment_textarea').val();
    // var img = document.createElement("IMG");
    // img.setAttribute("src", "img_pulpit.jpg");
    // img.setAttribute("width", "5");
    // img.setAttribute("height", "5");
    // img.setAttribute("alt", "The Pulpit Rock");
    // existing_text = existing_text + '8888888888888';
    // var i =img.toString();
    // var i =i.outerHTML;
    // $('#parent_comment_textarea').val("ll "+i);

  });
</script>

<script type="text/javascript">

      $(document).ready(function(){
        // show nd hide child_comments
        $(document).on('click','.show_reply_box_btn',function(){
            var bx = $(this).attr('id'); //get th parent id to create reply_box id
            var reply_box = '#reply_box' + bx; //get th parent id to create reply_box id
            $(reply_box).toggle(1000);

        });
        //===================

        // ==> ajax make parent coment
        $(document).on('click','#Comment_btn',function(){
            var parent_comment_textarea = $('#parent_comment_textarea').val();
            var parent_comment_as = $('#parent_comment_as').val();
            var singleID = <?php echo $singleID; ?>;// $singleID is in singlePost.php ..since this.php will be included we can use it
            var category = <?php echo $category; ?>;

            $.ajax({
                type:"POST",
                url:"ajax_gets/comments/ajax_parent_comment.php",
                data:{
                  parent_comment_textarea:parent_comment_textarea,
                  parent_comment_as:parent_comment_as,
                  singleID:singleID,
                  category:category
                },
                success:function(data){
                  $('.comment_container').html(data);
                }
            });
        });
        // ==============================

        // ==> ajax reply parent comments
        $(document).on('click','.reply_parent_btn',function(){
          var category = <?php echo $category; ?>;

          var btn_id = $(this).attr('id');
          var parent_ID = $(this).attr('name'); //parent id to b add at the end of other id's "make em unique"

          var get_comment_ID = "#commentR" + parent_ID; //== id of specific reply textarea
          var comment = $(get_comment_ID).val(); //get the reply comment

          var user = "Anonomuos";
          var singleID = <?php echo $singleID; ?>;// $singleID is in singlePost.php ..since this.php will be included we can use it

          var append_to = '#reply_box' + parent_ID; //id of the div we are going to overwrite with the new comments reply

            $.ajax({
                type:"POST",
                url:"ajax_gets/comments/ajax_reply_parent.php",
                data:{
                  parent_ID:parent_ID,
                  comment:comment,
                  user:user,
                  singleID:singleID,
                  category:category
                },
                success:function(data){
                  $(append_to).html(data);
                }
            });
        });
        // ==============================

      });

</script>
