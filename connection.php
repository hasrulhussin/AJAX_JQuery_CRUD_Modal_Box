<?php

$conn = mysqli_connect("localhost", "root", "", "jquery_crud");

if(!$conn){
    die ('Please Check Your Connection ' . mysqli_error());
}

?>
