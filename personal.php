
<?php

session_start();
?>

<link rel="stylesheet" href="./style.css">
<div class="back">
  <div class="welcome">Добро пожаловать в личный кабинет, <?php echo $_SESSION['user']; ?> </div>  
  <!-- ТУТ -->
    <div class="wrapper">      
        <main>
            <div class="sign_wrapp_personal">
                <div class="row_directory_link">
                  <label for="directory_link"><h2>Cсылка на профиль</h2> </label>
                  <input name="directory_link" class="directory_link" type="text" value ="<?php echo 'http://photo.loc/personal.php?directory=' . $_SESSION['email']; ?> " >
                  <!-- ТУТ -->
                </div> 
                <div class="a_wrap_personal">
                  <a class="personal_a" href="/exit.php">Выход</a>
                  <a class="personal_a" href="http://photo.loc/start.php">На главную</a>
                </div>
                <div class="pers_wrapp_area">
                  <div class="add">
                    <h2>Область загрузки</h2> 
                    <!-- ТУТ -->
                      <form action="/personal.php" method="POST" enctype="multipart/form-data">
                        <input type="file" class="personal_to_submit" name="myFile" multiple> 
                        <input type="submit" class="personal_to_submit" value="Отправить"> 
                      </form> 
                
<?php


$expensions= array("jpeg","jpg","png");

if (isset($_FILES['myFile'])) { 
  $errors =[];
  $uploadsDir = 'photo/';
  $file_size =$_FILES['myFile']['size'];
  $nameOfFile = $_FILES['myFile']['name'];
  $directoryName = $uploadsDir . $_SESSION['email'] . '/';
  if (is_dir($directoryName) == false){
    mkdir($directoryName);
  }
  $fileName = $directoryName . $_FILES['myFile']['name']; 


  $file_ext = strtolower(end(explode('.', $_FILES['myFile']['name']))); 
  if(in_array($file_ext,$expensions) === false){
    $errors[] = 'Данный формат не подлежит загрузке'; // проверку проходит по стр 35 но все ровно выгружает, хотя выгрузка в if-е на строке 42 + сыпет ошибку о приведении массива к строке
  }
  if($file_size --> 2097152){
    $errors[] = "Файл должен быть не более 2 Mb";
  }
  if (empty($errors)== true)  {
  (move_uploaded_file($_FILES['myFile']['tmp_name'], $fileName));

 
  
// условие отображание при загрузке 
  if($_SESSION['auth']===true)  {
      echo "<img class='to_center img_personal_add' src='$fileName'><br/>"; 
      ?>
        <label class="link" for="Прямая ссылка на картинку">Прямая ссылка на картинку</label>
        </br>
        <input type="text" class="to_center_straight" value="http://photo.loc/<?php echo $fileName ?>">
        </br>
      <?php                                           
      echo '<a class="delete" href="/delete.php?directory=' . $_SESSION['email'] . '&filename=' . $nameOfFile . '"> Удалить изображение </a>'; // сюда нужно будет добавить еще одно ветвление /ivan?filename=img.png
      }
      else {
        print_r ($errors);
      }
  }  
}

?>
              <div class="display">
                  <?php
                  // условие отображание при клике
                  if($_SESSION['auth']===true)  {
                      if (isset($_GET['img'])){
                        $newFileName= $_GET['img'];
                        echo "<img class='to_center img_personal_add' src='$newFileName'><br/>"; 
                        ?>
                        <label class="link" for="Прямая ссылка на картинку">Прямая ссылка на картинку</label>
                        </br>
                        <input type="text" class="to_center_straight" value="http://photo.loc/<?php echo $newFileName ?>">
                        </br>
                        <?php                                           
                        echo '<a class="delete" href="/delete.php?img='. $newFileName . '"> Удалить изображение </a>';
                      }
                    }    
                  ?>
                </div>
                </div> 
                  <div class="see">
                    <h2>Область просмотра</h2>  
                      <?php 
                      // отображение фото в области просмотра и настройка ссылок на фото
                      $dir_see = 'photo/' . $_SESSION['email'] . '/';
                      if (is_dir( $dir_see) == false){
                        echo 'У Вас еще нет загруженных файлов';
                        exit;
                      }
                      else{
                        $files_see = array_diff(scandir($dir_see), ['..', '.']); // тут добавить: если сессия = true, else переписать путь (разобрать GET['directory']  = directory=ivan@mail.ru пересобрать ссылку на папку пользователя)
                        echo '<div class="wrap_see_all">';
                        foreach ($files_see as $part){
                          echo '<a class="inner_a" href="/personal.php?img='. $dir_see . $part . '"><img class="inner_img"  src="' . $dir_see . $part . '" /></a>';
                      }
                      echo '</div>';
                      }
                      ?>  
                  </div>
              </div>  
            </div>
        </main>
  </div> 
</div> 


