<?php
  include("../../includes/db_connect.php");


if(isset($_POST['category_id'])){

  // delete category  BY THE WWAY this will also delete POSTS with that ID
      $category_id = $_POST['category_id'];
      $query = "DELETE FROM category WHERE id = '$category_id' ";
      $data = mysqli_query($conn,$query);
  // --------------


  //get updated table to replace the old one in index.php
        $query = "SELECT * FROM category";
        $result = mysqli_query($conn,$query);
?>
        <tr>
          <th>categoryID#</th>
          <th>Category</th>
          <th></th>
        </tr>
<?php
        while($row = mysqli_fetch_assoc($result)) {
?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><a href=""><?php echo $row['category_name']; ?></a></td>
            <td><input type="submit" class="delete_category" name="delete" value="X" id="<?php echo $row['id']; ?>" ></td>
          </tr>
<?php } //

}

?>
