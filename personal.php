<?php
require_once __DIR__ . '\logger.php';  //new нужно ли это подключение
use photo_project\Logger; //new

$logger = new Logger;                                                                                                  //new
    $logger                                                                                                            //new
        ->setDataFormat('Y-m-d H:i:s')                                                                                 //new
        ->setlogType('file');   

session_start();
?>

<link rel="stylesheet" href="./style.css">
<div class="back">

<?php
if (isset($_SESSION['auth']) && $_SESSION['auth'] === true){
  echo '<div class="welcome">Добро пожаловать в личный кабинет, ' . $_SESSION['user'] . '</div>';
}
?>
  
    <div class="wrapper">      
        <main>
            <div class="sign_wrapp_personal">
                <div class="row_directory_link">
                             
                <?php
                if (isset($_SESSION['auth']) && $_SESSION['auth'] === true){
                  echo '<label for="directory_link"><h2>Cсылка на профиль</h2> </label>';    
                  echo '<input name="directory_link" class="directory_link" type="text" value ="http://photo.loc/personal.php?directory=' . $_SESSION['email'] . '" >';
                
                  echo 
                '</div> 
                  <div class="a_wrap_personal">
                  <a class="personal_a" href="/exit.php">Выход</a>
                  <a class="personal_a" href="http://photo.loc/start.php">На главную</a>
                </div>';
              }
           
                    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true){
                      echo '<div class="pers_wrapp_area">';
                      echo  '<div class="add">';
                      echo '<h2>Область загрузки</h2> ';
                      echo '<form action="/personal.php" method="POST" enctype="multipart/form-data">';
                      echo '<input type="file" class="personal_to_submit" name="myFile" multiple>'; 
                      echo '<input type="submit" class="personal_to_submit" value="Отправить">'; 
                      echo '</form>'; 
                    }
                    ?>
                
<?php


$expensions= array("jpeg","jpg","png");

if (isset($_FILES['myFile'])) { 
  $errors =[];
  $uploadsDir = 'photo/';
  $file_size =$_FILES['myFile']['size'];
  $nameOfFile = $_FILES['myFile']['name'];

  $ext = substr($nameOfFile, strpos($nameOfFile,'.'), strlen($nameOfFile)-1); // чек

  $directoryName = $uploadsDir . $_SESSION['email'] . '/';
  if (is_dir($directoryName) == false){
    mkdir($directoryName);
  }

  $fileName = $directoryName . $_FILES['myFile']['name']; 

  $file_ext = strtolower(end(explode('.', $_FILES['myFile']['name']))); 
  if(in_array($file_ext,$expensions) === false){
    $errors[] = 'Данный формат не подлежит загрузке';
    
    $message ='Пользователь с email: ' . $_SESSION['email'] . ' пытался загрузить файл с не поддерживаемым форматом';  //new
    $logger->log($message);                                                                                            //new

  }
  if($file_size --> 2097152){
    $errors[] = "Файл должен быть не более 2 Mb";

    $message ='Пользователь с email: ' . $_SESSION['email'] . ' пытался загрузить файл оъемом выше 2Mb';               //new
    $logger->log($message);                                                                                            //new 

  }
  if (empty($errors)== true)
    {

  $randomName = uniqid('file_');    
  // (move_uploaded_file($_FILES['myFile']['tmp_name'], $directoryName . uniqid('file_') . $ext));
  (move_uploaded_file($_FILES['myFile']['tmp_name'], $directoryName . $randomName . $ext));

  $message ='Загружено изображение : ' . $randomName;               //new
  $logger->log($message);                                                                                            //new 
  
  // (move_uploaded_file($_FILES['myFile']['tmp_name'], $fileName)); 
  header('Location: personal.php?img=' .  $uploadsDir . $_SESSION['email'] . '/' . $randomName . $ext);
 
 
  
// условие отображание при загрузке, можно удалять, переписал через GET в модуле отображения будет срабатывать в двух случаях стр 85-96
  if($_SESSION['auth']===true)  {
      echo "<img class='to_center img_personal_add' src='$fileName'><br/>";
      // echo '<img class="to_center img_personal_add" src="personal.php?directory=' . $_SESSION['email'] .  '?img=' . $randomName . $ext . '"><br/>';  
      ?>
        <label class="link" for="Прямая ссылка на картинку">Прямая ссылка на картинку</label>
        </br>
        <input type="text" class="to_center_straight" value="http://photo.loc/<?php echo $fileName ?>">
        </br>
      <?php                                           
      // echo '<a class="delete" href="/delete.php?directory=' . $_SESSION['email'] . '&filename=' . $nameOfFile . '"> Удалить изображение </a>'; // сюда нужно будет добавить еще одно ветвление /ivan?filename=img.png
      }
      
  }
  else {
    print_r ($errors);
  }  
}

?>
              <div class="display">
                  <?php
                  // условие отображание при клике
                  if(isset($_SESSION['auth']) && $_SESSION['auth']===true)  {
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
                    if (isset($_SESSION['auth']) && $_SESSION['auth'] === true){
                        $dir_see = 'photo/' . $_SESSION['email'] . '/';
                        if (is_dir( $dir_see) == false){
                          echo 'У Вас еще нет загруженных файлов';
                          exit;
                        }                
                        else{                    
                            $files_see = array_values(array_diff(scandir($dir_see), ['..', '.'])); 
                            echo '<div class="wrap_see_all">';
                            $page = 1;
                                if (isset($_GET['page'])){
                                  $page = (int) $_GET['page'];
                                }
                            $amountOfImages= 9;
                            $to = $page*$amountOfImages;
                            $from =$to-$amountOfImages;
                              for ($i=$from; $i<$to; $i++){
                                if ($i>=count($files_see)){
                                  break;
                                }
                                $part = $files_see[$i];
                                echo '<a class="inner_a" href="/personal.php?img='. $dir_see . $part . '"><img class="inner_img"  src="' . $dir_see . $part . '" /></a>';
                              }
                            echo '</div>';
                            
                            if($from != 0){
                              echo '<a class="page_plus_minus" href="http://photo.loc/personal.php?page=' . $page-1 . '" >Предыдущая страница</a>';
                            }
                            if($to<(int) count($files_see)){
                              echo '<a class="page_plus_minus" href="http://photo.loc/personal.php?page=' . $page+1 . '" >Следующая страница</a>';
                            }                             
                        }
                    }



                    // условие отображения области с фото без авторизации
                    else{

                      $keepDir = $_GET['directory'];
                      $dir_see = 'photo/' . $keepDir . '/';                     
                        if (is_dir( $dir_see) == false){
                        echo 'У Вас еще нет загруженных файлов';
                        exit;
                      }

                      $files_see = array_values(array_diff(scandir($dir_see), ['..', '.'])); 
                      echo '<div class="wrap_see_all">';
                      $page = 1;
                          if (isset($_GET['page'])){
                            $page = (int) $_GET['page'];
                          }
                      $amountOfImages= 9;
                      $to = $page*$amountOfImages;
                      $from =$to-$amountOfImages;
                        for ($i=$from; $i<$to; $i++){
                          if ($i>=count($files_see)){
                            break;
                          }
                          $part = $files_see[$i];
                          echo '<img class="inner_a"  src="' . $dir_see . $part . '" />';
                        }
                      echo '</div>';
                      
                      if($from != 0){
                        echo '<a class="page_plus_minus" href="http://photo.loc/personal.php?directory=' . $keepDir . '?page=' . $page-1 . '" >Предыдущая страница</a>';
                      }
                      if($to<(int) count($files_see)){
                        echo '<a class="page_plus_minus" href="http://photo.loc/personal.php?directory=' . $keepDir . '?page=' . $page+1 . '" >Следующая страница</a>';
                        // В ситуации где мы работаем с авторизованной страницей значение keepDir хранится в сессии  и не требует изменение ссылки
                      } 
                      
                      // $files_see = array_diff(scandir($dir_see), ['..', '.']); 
                      // echo '<div class="wrap_see_all">';
                      // foreach ($files_see as $part){
                      //     echo '<img class="inner_a" src="' . $dir_see . $part . '" />';
                      // }
                      // echo '</div>'; 

                    } 
                    ?>  
                  </div>
              </div>  
            </div>
        </main>
  </div> 
</div> 

<!-- вопрос стилизации одних и тех же блоков при разных условиях, к примеру, при  наличии/отсутствии авторизации -->