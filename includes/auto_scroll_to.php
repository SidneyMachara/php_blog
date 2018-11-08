<script type="text/javascript">
var scroll_Y = 0;
var distance = 40;
var speed = 30;


//scroll down
function auto_scroll_to(el){
  var current_Y = window.pageYOffset; //how far u hav scrolled from the to
  var target_Y = document.getElementById(el).offsetTop; //how far it is into the parent element
//next 2 variables are to avoid more scrolling when u get otbottom
  var body_height = document.body.offsetHeight;
  var y_pos = current_Y + window.innerHeight;
  var animator = setTimeout('auto_scroll_to(\''+el+'\')',speed);

  if(y_pos > body_height){
      clearTimeout(animator);
  }else{

    if(current_Y > target_Y - distance){
        scroll_Y = current_Y + distance;
        window.scroll(0,scroll_Y);
    }else{
      clearTimeout(animator);
    }

  }
}

// scroll up
function auto_scroll_TOP(el){
  var current_Y = window.pageYOffset; //how far u hav scrolled from the to
  var target_Y = document.getElementById(el).offsetTop; //how far it is into the parent element

  var animator = setTimeout('auto_scroll_TOP(\''+el+'\')',speed);

    if(current_Y > target_Y){
        scroll_Y = current_Y - distance;
        window.scroll(0,scroll_Y);
    }else{
      clearTimeout(animator);
    }


}
</script>
