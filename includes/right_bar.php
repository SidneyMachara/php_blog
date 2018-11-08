<!-- about and popular -->
<div class="right_container">

  <div class="about_me" >
    <h4>About Me (*.*)</h4>
    <p>Lorem ipsum dolor sit amet, consectetur
      adipisicing elit, sed do eiusmod tempor
      incididunt ut labore et dolore magna aliqua.
      Lorem ipsum dolor sit amet, consectetur

          adipisicing elit, sed do eiusmod tempor
        incididunt ut labore et dolore magna aliqua.                   s
     mollit anim id est laborum.
   </p>

  </div>

  <!-- =popular_posts -->
  <div class="popular_posts">
    <h4>Popular posts</h4>

    <!-- get popular form db -->
    <?php
      $query = "SELECT * FROM posts ORDER BY post_rank DESC LIMIT 5 ";
      $result = mysqli_query($conn,$query);

      while($row = mysqli_fetch_assoc($result)) {
     ?>

    <div class="popular_boxes">

      <a href="singlePost.php?singleID='<?php echo urlencode($row['id']); ?> '">
      <img src="post_images/<?php echo $row['image'] ?>" alt="" class="popular_img">
      </a>

      <div class="popular_title">
          <h5><a href="singlePost.php?singleID='<?php echo urlencode($row['id']); ?> '"><?php echo $row['title']; ?></a></h5>

      </div>
    </div>
    <hr>

    <?php } ?>
  </div>




  <div class="category" id="categoryy">
    <h4>Category</h4>
    <ul class="category_list">

      <!-- get category from database -->
        <?php
          $query = "SELECT * FROM category";
          $result = mysqli_query($conn,$query);

          while($row = mysqli_fetch_assoc($result)) {
         ?>

      <li><a href="index.php?category=<?php  echo urlencode($row['id']); ?>"><?php  echo $row['category_name']; ?></a></li>
      <hr>

      <?php } ?>
      <!-- end of get category fronm db -->


    </ul>
  </div>

</div>
