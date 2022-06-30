<?php

spl_autoload_register('autoloader');

/**
 * @param $name
 * @return bool
 */
function autoloader($name){
    $path = "classes/";
    $ext = ".php";
    $file = $path . $name . $ext;

    if(file_exists(!$file)) return false;

    include_once $path . $name .$ext;
}