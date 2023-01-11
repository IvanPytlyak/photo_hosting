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
          <div class="pers_wrapp_area">
            <div class="add">
              <h2>Область загрузки</h2> 
                <form action="/personal.php" method="POST" enctype="multipart/form-data">
                  <input type="file" class="personal_to_submit" name="myFile" multiple>

                  <input type="submit" class="personal_to_submit" value="Отправить"> 
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
    $$errors[] = 'Данный формат не подлежит загрузке'; // проверку проходит по стр 35 но все ровно выгружает, хотя выгрузка в if-е на строке 42 + сыпет ошибку о приведении массива к строке
  }
  if($file_size --> 2097152){
    $errors[] = "Файл должен быть не более 2 Mb";
  }
 if (empty($errors)== true)  {
  (move_uploaded_file($_FILES['myFile']['tmp_name'], $fileName));


  // for ($i=0; $i< count($_FILES['myFile']['name']); $i++){                    // необходим комментарий по корректности оформления ссылки
  //   echo '<img src=' . $uploadsDir . $_FILES['myFile']['name'][$i] . '><br/>';     // и корректности отображения ссылки под выгруженным изображением
  // }

  echo "<img class='to_center img_personal_add' src='$fileName'><br/>";
  ?>
  <label class="to_center" for="Прямая ссылка на картинку">Прямая ссылка на картинку</label>
  </br>
  <input type="text" class="to_center" value="http://photo.loc/<?php $fileName ?>">  <!-- не отображает $fileName  -->
  </br>
  <?php
  // echo  'http://photo.loc/'. $fileName . '<br/><br/>';                                                
  echo '<a class="to_center" href="/delete.php?filename=' . $nameOfFile . '"> Удалить изображение </a>'; 
  }
  else {
    print_r ($errors);
  }
  
// после повторного нажатия на submit загруженное изображение пропадает

}


?>
            </div> 
            <div class="see">
              <h2>Область просмотра</h2>  
                <?php 
                $dir = '/photo/';
                $scan = scandir($_SERVER['DOCUMENT_ROOT'].$dir); // дописать ограничение на виды файлов по анологии с стр 26/ стр39-45
                foreach ($scan as $part){
                  echo '<img src="'.$dir.$part.'" /><br/>';
                }
                // решает вопрос выгрузки всей папки но не дает деталюзацию отображения относительно пользователя
                // при загрузке формировать массив имен картинок относительно авторизированного пользователя?
                ?>  
            </div>
          </div>  

</div>
    </main>
        </div> 


