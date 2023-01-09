<link rel="stylesheet" href="./style.css">

<div class="wrapper">      
    <main>
        <div class="back"></div>
        <div class="sign_wrapp_personal">

          <h1>Личный кабинет</h1>
          <div class="a_wrap_personal">
          <!-- <a href="?logout">Выйти</a> -->
            <a class="personal_a" href="/exit.php">Выход</a>
            <a class="personal_a" href="http://photo.loc/start.php">На главную</a>
          </div>
          <form action="/personal.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="myFile" multiple>

            <input type="submit" value="Отправить"> 
          </form> 
          
<?php

$expensions= array("jpeg","jpg","png");




if (isset($_FILES['myFile'])) { // если не проверять получим 2 строки ошибок до импорта файлов
  $errors =[];
  $uploadsDir = 'photo/';
  $file_size =$_FILES['myFile']['size'];
  $nameOfFile = $_FILES['myFile']['name'];
  $fileName = $uploadsDir . $_FILES['myFile']['name']; // ссылка на файл?  $uploadsDir .  // по факту получается ссылка на личный кабинет, отдельная ссылка для просмотра реализовать через cookie - токен?


  $file_ext = strtolower(end(explode('.',$_FILES['myFile']['name']))); // почему-то не работает проверка по svg, проходит проверку
  if(in_array($file_ext,$expensions) === false){
    $$errors[] = 'Данный формат не подлежит загрузке';
  }
  if($file_size --> 2097152){
    $errors[] = "Файл должен быть не более 2 Mb";
  }
 if (empty($errors)== true)  {
  (move_uploaded_file($_FILES['myFile']['tmp_name'], $fileName));


  // for ($i=0; $i< count($_FILES['myFile']['name']); $i++){                    // необходим комментарий по корректности оформления ссылки
  //   echo "<img src='$uploadsDir . $_FILES['myFile']['name'][$i]'><br/>";     // и корректности отображения ссылки под выгруженным изображением
  // }

  echo "<img src='$fileName'><br/>";                                                   
  echo '<a href="/delete.php?filename=' . $nameOfFile . '"> Удалить изображение </a>'; 
  }
  else {
    print_r ($errors);
  }
  

// после повторного нажатия на submit загруженное изображение пропадает

}
?>


</div>
    </main>
        </div> 


