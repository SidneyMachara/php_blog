<?php
  include("../../includes/db_connect.php");
  include("../../includes/fomater.php");

if(isset($_POST['post_id'])){



      //delete ppost and its comments
      if(empty($_POST['category_id'])){

        $post_id = $_POST['post_id'];
        $query = "DELETE FROM posts WHERE id = '$post_id'";
        mysqli_query($conn,$query);


        //delete comments for deleted post
        $query = "SELECT id from comments WHERE post_id = '$post_id'" ; //get  the id of every parent comment that is to be deletedd
        $comment_childern = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($comment_childern)) { //delete all the rplies of that comment
          $parent_comment_id = $row['id'];
          $query = "DELETE FROM comments WHERE parent_comment = '$parent_comment_id'";
          mysqli_query($conn,$query);
        }
        //now delete the parent comments
        $query = "DELETE FROM comments WHERE post_id = '$post_id'";
        mysqli_query($conn,$query);

      }
      //==============================================
      //==
      //=============================================

      // delete posts whoes cataegory has been deleted ==="and thier comments"
      if(empty($_POST['post_id'])){

        $category_id = $_POST['category_id'];
        //delete the posts whoes category was deleted
        $Delete_posts_of_category = "DELETE FROM posts WHERE category = '$category_id'"; //deletes posts associated with that category
        mysqli_query($conn,$Delete_posts_of_category);

        //delete comments for deleted posts
        $query2 = "DELETE FROM comments WHERE category = '$category_id'" ;
        mysqli_query($conn,$query2);


      }


  // --------------



  //get updated table to replace the old one in index.php
  $query = "SELECT posts.*, category.category_name
            FROM posts
            INNER JOIN category
            ON posts.category = category.id";
  $result = mysqli_query($conn,$query);
?>

  <tr>
    <th>PostID#</th>
    <th>Post Title</th>
    <th>Category</th>
    <th>Author</th>
    <th>Date</th>
    <th></th>
  </tr>

<?php
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

<?php
}
}
?>
