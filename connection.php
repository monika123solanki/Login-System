<?php

$con = mysqli_connect("localhost", "root", "1234", "crud");

if(mysqli_connect_errno()){
    die("Can't connect to database".mysqli_connect_errno());
}

define("UPLOAD_SRC", $_SERVER['DOCUMENT_ROOT']."/uploads/");

define("FETCH_SRC", "/uploads/");
?>
