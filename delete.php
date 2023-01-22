<?php

require_once __DIR__ . '\logger.php';  //new нужно ли это подключение
use photo_project\Logger;                                                                                              //new
$logger = new Logger;                                                                                                  //new
    $logger                                                                                                            //new
        ->setDataFormat('Y-m-d H:i:s')                                                                                 //new
        ->setlogType('file');   

session_start();
include 'personal.php';

if (isset($_GET['filename']) && isset($_GET['directory'])){    // для загруженных файлов (из области загрузки), чек эта часть уже не нужна

    $message ='Удалено изображение по адресу: ' . $_GET['img'];               //new
    $logger->log($message);                                                   //new

    unlink('photo/' . $_GET['directory'] . '/'. $_GET['filename']);
    header('Location: personal.php');

}
elseif(isset($_GET['img'])){ // для отображенных файлов

    $message ='Удалено изображение по адресу: ' . $_GET['img'];               //new
    $logger->log($message);                                                   //new
    
    unlink($_GET['img']);
    header('Location: personal.php'); 
}


