<?php

require_once __DIR__ . '\logger.php';  //new нужно ли это подключение
use photo_project\Logger; 
$logger=new Logger;
 

session_start();
include 'personal.php';

if(isset($_GET['img'])){ // для отображенных файлов           
    $logger->recordToFile('Удалено изображение по адресу: ' . $_GET['img']);                                                          
    unlink($_GET['img']);
    header('Location: personal.php'); 
}


