<?php
include("../../includes/db_connect.php");


if(isset($_POST['category'])){

    $category = $_POST['category'];

    $query = "INSERT INTO category (category_name) VALUES ('$category')";
    mysqli_query($conn, $query);

}




 ?>
 <h2>Hello <?php echo $_SESSION['username']; ?></h2>

 <div class="msg_updated">Category "<?php echo $category ?>" added</div>
 <p>Category Name</p>
 <input type="text" name="category" value="" required id="category" autofocus>
 <input type="submit" name="add" value="Add" class="add_category_">
 <input type="submit" name="delete" value="Delete" class="delete">
