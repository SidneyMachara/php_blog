<?php
  include("../includes/db_connect.php");
  include("../includes/fomater.php");

if(isset($_POST['offset']) && isset($_POST['limit'])){

      $limit = $_POST['limit'];
      $offset = $_POST['offset'];

      $query = "SELECT * FROM posts ORDER BY date_published DESC LIMIT {$limit} OFFSET {$offset} ";
      $data = mysqli_query($conn,$query);


      while($row = mysqli_fetch_assoc($data)) {
     ?>

      <div class="post_box">
        <img src="post_images/<?php echo $row['image'] ?>" alt="" class="post_img">

        <div class="post_details">
          <h3><?php echo $row['title']; ?></h3>

          <hr>
          <p class="date_author"><?php echo format_date($row['date_published']); echo" ....... by ". $row['author'];?></p>

          <div class="post">
            <p>
                <?php echo shorten_text($row['body']); ?>
            </p>
          </div>

          <a href="singlePost.php?singleID='<?php echo urlencode($row['id']); ?> ' " class="read_more">Read More</a>

        </div>
      </div>

      <?php
    }


}



 ?>
