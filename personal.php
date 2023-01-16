
<?php

session_start();
?>

<link rel="stylesheet" href="./style.css">

<div class="wrapper">      
    <main>
        <div class="back"></div>
        <div class="welcome">Добро пожаловать в личный кабинет, <?php echo $_SESSION['user']; ?> </div> 

        <div class="sign_wrapp_personal">

          <h1>Личный кабинет</h1>  
          <!-- удалить -->
          <div class="row_directory_link">
            <label for="directory_link"><h2>Cсылка на профиль</h2> </label>
            <input name="directory_link" class="directory_link" type="text" value ="<?php echo 'http://photo.loc/personal.php?directory=' . $_SESSION['email']; ?> " >
          </div> 
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
         


          <!-- <form action="/personal.php" method="POST" enctype="multipart/form-data">
              Загрузка каталога:<br />
              <input name="userfile[]" type="file" webkitdirectory multiple />
              <input type="submit" value="Загрузить файлы" />
          </form>       -->
          <!-- не видит файлы для выгрузки -->
         

                
<?php

// function reArrayFiles($file_post) { // берем выгруженный файл '&'-?

//   $file_ary = array();
//   $file_count = count($file_post['name']); // длинна массива выгруженного файла
//   $file_keys = array_keys($file_post); // массив его ключей

//   for ($i=0; $i<$file_count; $i++) {
//       foreach ($file_keys as $key) {
//           $file_ary[$i][$key] = $file_post[$key][$i];
//       }
//   }
//   return $file_ary;
// }

// if ($_FILES['upload']) { // $_FILES['upload'] - загруженный файл, // если файл загружен?
//   $file_ary = reArrayFiles($_FILES['ufile']); // $_FILES['ufile'] - что под этим подразумевается?

//   foreach ($file_ary as $file_1) {
//       print 'File Name: ' . $file_1['name'];
//       print 'File Type: ' . $file_1['type'];
//       print 'File Size: ' . $file_1['size'];
//   }
// }










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

  // в виду того что в форме установлено enctype="multipart/form-data", есть возможность выгружать несколько картинок одновременно,
  // тут пытаюсь решить вопрос их отображения при импорте
  // for ($i=0; $i< count($_FILES['myFile']['name']); $i++){                    // необходим комментарий по корректности оформления ссылки
  //   echo '<img src=' . $uploadsDir . $_FILES['myFile']['name'][$i] . '><br/>';     // и корректности отображения ссылки под выгруженным изображением
  // }
  

  echo "<img class='to_center img_personal_add' src='$fileName'><br/>"; 
  ?>
  <label class="to_center" for="Прямая ссылка на картинку">Прямая ссылка на картинку</label>
  </br>
  <input type="text" class="to_center" value="http://photo.loc/<?php echo $fileName ?>">
  </br>
  <?php                                           
  echo '<a class="to_center_a" href="/delete.php?directory=' . $_SESSION['email'] . '&filename=' . $nameOfFile . '"> Удалить изображение </a>'; // сюда нужно будет добавить еще одно ветвление /ivan?filename=img.png
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
                $dir_see = 'photo/' . $_SESSION['email'] . '/';
                if (is_dir( $dir_see) == false){
                  echo 'У Вас еще нет загруженных файлов';
                  exit;
                }
                else{
                  $files_see = array_diff(scandir($dir_see), ['..', '.']);// получили список изображений пользователя (массив), зачем сравнивать массивы?
                  echo '<div class="wrap_see_all">';
                  foreach ($files_see as $part){
                    echo '<img class="inner_img" src="' . $dir_see . $part . '" /><br/>'; 
                }
                echo '</div>';
                }
                ?>  
            </div>
          </div>  

</div>
    </main>
        </div> 


