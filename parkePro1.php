<?php

function sanitize_content($text){
    if(isset($text)&&$text!='' ){
        $allowString = '<b>, <a>,<i>, <img>';
        $text = strip_tags($text, $allowString);
    }
    elseif(!isset($text)){
        $text ='No Comment';
    }
    return $text;
}




