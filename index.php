<?php
  include("includes/head.php");
  include("includes/navbar.php");
  include("includes/fomater.php");




if(isset($_POST['search'])){

    include("ajax_gets/search_filter.php");

}elseif(isset($_GET['category'])){ //$_GET['category'] ==> comes from right_bar.php

    include("ajax_gets/category_filter.php"); //when u click on category this calls category_filter.php to get posts by category

}else{ //default dispaly before search or filters



?>

<!-- this is th ajax that loads posts to
 the left_container class "scroll down
 ulll see it (*.*)" -->
<script type="text/javascript">
    $(document).ready(function(){

      var flag =0;
      var no_more_posts = false;


      function load_posts() //this function is to avoid duplicating th ajax code ..in th on scroll listener down there
      {
          $.ajax({
              type:"POST",
              url:"ajax_gets/get_posts.php",
              cache:false,
              data:{
                'offset':flag,
                'limit':3

              },
              success:function(data){

                    if(data == false && no_more_posts == false){

                        $('.left_container').append("<p class='no_posts_found'>There are no Posts .. !! Sorry (^.^)</p>");
                        no_more_posts = true;
                    }else if(no_more_posts == false){

                        // choose th container u want the data to go inside
                        $('.left_container').append(data);
                        flag += 3;

                  }
              }
          });

      }
      //now calling th function load_posts(flag)
      load_posts();

      function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}

        // make ajax load more data on scroll
        //=========> Ajax will work without this part but wont load data on scroll
          $(window).scroll(function(){ //th + 70 is so that the scroll bar doesnt reach bottom..u can remove it
              // var a = $(document).height();
              // var b =   ($(window).scrollTop() + $(window).height());
              // var $win = $(window);
              // $(".nav_outer").html(a+" k "+b)

                if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                    alert(flag);

                load_posts();
              // ------------------------------
            }
          });

        //=====>end of make ajax load more data on scroll
    });
</script>

<?php
}  //end of else default posts
 ?>
 <!DOCTYPE html>
 <html>

  <body>



      <div class="blog_content ">

          <div class="left_container">

                <!-- this is filled with posts by ajax calls  -->

          </div>

<!-- right_bar -->
        <?php include("includes/right_bar.php"); ?>

      </div>


<!-- ============================ -->
<a href="#" onclick="return false;"  class="backToTop" ><center>&#8686; </center></a>
<?php   include("includes/auto_scroll_to.php"); ?>
<script type="text/javascript">
      $(document).ready(function(){
        $(document).on('mousedown','.backToTop',function(){
          auto_scroll_TOP('top'); //top is id of a div in navbar.php
        });
      });
</script>
<!-- ================================ -->


  </body>
  <?php include("includes/subscribe.php"); ?>
  <?php include("includes/footer.php"); ?>
</html>
