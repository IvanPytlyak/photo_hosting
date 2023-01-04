<h1>Личный кабинет</h1>
<!-- <a href="?logout">Выйти</a> -->
<a href="/">Выход</a>
<br/><br/>

<form action="/personal.php" method="POST" enctype="multipart/form-data">
  <input type="file" name="myFile">

  <input type="submit" value="Submit"> 
</form> 

<?php

if (isset($_FILES['myFile'])) { // если не проверять получим 2 строки ошибок до импорта файлов
    $uploadsDir = 'photo/';
    $fileName = $uploadsDir . $_FILES['myFile']['name']; // ссылка на файл?  $uploadsDir .  // по факту получается ссылка на личный кабинет, отдельная ссылка для просмотра реализовать через cookie - токен?
    // что сделать, чтобы в личном кабинете отображались файлы из папки?

    // print_r($fileName);
    (move_uploaded_file($_FILES['myFile']['tmp_name'], $fileName));


    // if (move_uploaded_file($_FILES['myFile']['tmp_name'], $fileName)) {
    //     echo 'Файл загружен!';
    // } else {
    //     echo 'Ошибка загрузки файла!';
    // }


    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';

    echo "<img src='$fileName'><br/>"; 
}

// после повторного нажатия на submit загруженное изображение пропадает

