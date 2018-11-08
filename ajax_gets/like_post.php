<?php


if(isset($_POST['singleID'])){
  
include("../includes/db_connect.php");
$singleID = $_POST['singleID'];

// get current number of likes
$query = "SELECT likes FROM posts WHERE id = $singleID";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
$current_likes = $row['likes'];
  // ---------------------------

$new_likes = $current_likes + 1;

  // update likes
  $query3 = "UPDATE posts SET likes = '$new_likes' WHERE id = $singleID";
  mysqli_query($conn,$query3);

  //get new number of likes
  $query = "SELECT post_rank,likes FROM posts WHERE id = $singleID";
  $result = mysqli_query($conn,$query);
  $row = mysqli_fetch_assoc($result);
  $likes = $row['likes'];

  echo $likes." ".'likes'; //display in browser


  // ===============================
  // increase rank
  // ===============================
  $current_rank = $row['post_rank'];
  $new_rank = $current_rank + 1;

  $query2 = "UPDATE posts SET post_rank = '$new_rank' WHERE id = $singleID";
  mysqli_query($conn,$query2);

}
 ?>
