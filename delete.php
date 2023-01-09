<?php
include 'personal.php';

if (isset($_GET['fileName'])){
    unlink('photo/' . $_GET['fileName']);
    header('Location: personal.php');
}



// if( isset( $_POST[ 'delite' ] ) ) {
//     unlink('$path');
// echo $path;
//    }


// var_dump($_POST);