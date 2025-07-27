<?php


if(!isset($_FILES["file"]))
{
    highlight_file(__FILE__);
    exit();
}

file_put_contents("/tmp/flag.txt",$_ENV["TARMAN_DYNAMIC_FLAG"]);

if ($_FILES["file"]["type"] == "image/jpg" || $_FILES["file"]["type"] == "image/png" || $_FILES["file"]["type"] == "image/jpeg") {
    if(substr(strtolower($_FILES["file"]["name"]), -4) === '.php')
        die('Hacker!');
    $type = strtolower(substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1)); 
    $dst_filename = time() . rand(0, 999999) . "." . $type;
    $filename = "./upload/" . $dst_filename;
    move_uploaded_file($_FILES["file"]["tmp_name"], $filename);
    echo "/upload/" . $dst_filename;
} else {
        die('Invalid file type.');
}
