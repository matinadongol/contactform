<?php

function debugger($data, $is_die = false){
    echo "<pre style = 'color: #FF0000;'>";
    print_r($data);
    echo "</pre>";
    if($is_die){
        exit;
    }
}

function redirect($path){
    @header('location: '.$path);
    exit;
}
    
function sanitize($str){
    $str = rtrim($str);
    $str = stripslashes($str);
    $str = addslashes($str);
    $str = strip_tags($str); //htmlentities() => html_entity_decode()
    return $str;
}

?>