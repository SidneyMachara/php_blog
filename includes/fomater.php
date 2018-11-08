<?php
// format date
function format_date($date){
  return date('F j, Y, g:i a',strtotime($date));
}

function shorten_text($text,$chars = 250){
  $text = $text." ";
  $text = substr($text,0,$chars);
  // so it dowe not cut a stinfg in th middle
  $text = substr($text,0,strrpos($text,' '));
  $text = $text." .....";

  return $text;

}

 ?>
