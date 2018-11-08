<?php
$group = "";
if(isset($_SESSION['group'])){
  $group = $_SESSION['group']; //to be used by navbar.php "show or hide dashboard link"
}

 ?>

<nav class="nav_outer" id="top">
  <div class="nav_content">

<?php include("mobile_nav.php"); ?>
    <ul class="nav_ul">
      <li><a href="index.php">Home</a></li>
      <?php if($group == 'ADMIN') {?>
      <li><a href="admin/index.php">Dashboard</a></li>
      <?php } ?>
      <li><a href="#"  onclick="return false;">About</a></li>


    </ul>

<!-- metho=POST WASNT WORKING WITH AJAX -->
    <form class="search_container" action="index.php" method="POST">
      <input type="text" name="searchQuery" value="" required class="search_box" placeholder="Search ...">

      <button class="search_btn" type="submit" name="search"><i class="glyphicon glyphicon-search"></i></button>
    </form>

<!-- this is to keep the required error message from showing -->
    <script type="text/javascript">
        document.addEventListener('invalid', (function () {
          return function (e) {
              e.preventDefault();
              document.getElementByClass("search_box").focus();
          };
        })(), true);
    </script>
<!-- ======================= -->

  </div>


</nav>

<!-- log -->
<div class="logo">
  <!-- <h1>Peace Society</h1> -->

</div>

<!-- sloggan -->
<div class="slogan">
  <div class="slogan_content">
      <h3>Life As a Science</h3>
  </div>

</div>

<!-- for showing and hidding search box -->
<script type="text/javascript">
    $(document).ready(function()
    {
      var serach_bar_flag =0;
      // console.log("am in bitch");

       $(".search_btn").click(function() {
         if( serach_bar_flag == 0){
           $(".search_box").show(600)
           serach_bar_flag = 1;
         }else{
           $(".search_box").hide(600)
           serach_bar_flag = 0;
         }
       });

      // change background color of navbar on scroll
      $(window).scroll(function(){

          if(window.pageYOffset > 100){
              // $('.nav_content').css({'background-color':'black',color:'white'});
              // $('.nav_content').css({'background-color':'white'});
              // $('.nav_content a').css({'background-color':'black',color:'white'});
          }else{
              // $('.nav_content').css({'background-color':'white'});
              // $('.nav_content a').css({'background-color':'white',color:'black'});
              // $('.nav_ul li a:hover').css({'background-color':'gray',color:'black'});
          }
      });

     });
 </script>
