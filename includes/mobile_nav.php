<!-- <button type="button" name="button" class="box">



</button> -->
<div class="mobile_nav_box">
  <hr class="mobile_inner_box">
  <hr class="mobile_inner_box">
  <hr class="mobile_inner_box">
</div>

<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click','.mobile_nav_box',function(){
    $('.nav_ul').slideToggle();
  });

});

</script>
