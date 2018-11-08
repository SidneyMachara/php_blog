<?php


$searchQuery = $_POST['searchQuery'];

 ?>

 <!-- this is th ajax that loads posts to
  the left_container class "scroll down
  ulll see it (*.*)" -->
 <script type="text/javascript">

     $(document).ready(function(){
       var sflag =0;
       var no_more_posts = false;

       function load_posts() //this function is to avoid duplicating th ajax code ..in th on scroll listener down there
       {
           $.ajax({
               type:"POST",
               url:"ajax_gets/get_posts_by_search.php",
               data:{
                 'offset':sflag,
                 'limit':3,
                 'searchQuery': '<?php echo $searchQuery; ?>' // ' ' <---required if its a string


               },
               success:function(data){
                   if(data == false && (no_more_posts == false)){

                       $('.left_container').append("<p class='no_posts_found'>There are no Posts ... !! Sorry (^.^)</p>");
                       no_more_posts = true;
                   }else if(no_more_posts == false){
                       // choose th container u want the data to go inside
                       $('.left_container').append(data);
                       sflag += 3;

                  }
               }
           });
         }
         //now calling th function load_posts(flag)
         load_posts();

         // make ajax load more data on scroll
         //=========> Ajax will work without this part but wont load data on scroll
           $(window).scroll(function(){
             if($(window).scrollTop() >= $(document).height() - $(window).height()){

                 load_posts();
               // ------------------------------
             }
           });
         //=====>end of make ajax load more data on scroll

     });
 </script>
