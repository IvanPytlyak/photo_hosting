<?php
session_start();
include 'personal.php';

if (isset($_GET['filename']) && isset($_GET['directory'])){
    unlink('photo/' . $_GET['directory'] . '/'. $_GET['filename']);
    header('Location: personal.php');
}


