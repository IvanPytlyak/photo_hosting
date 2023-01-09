<link rel="stylesheet" href="./style.css">


<div class="wrapper">      
    <main>
        <div class="back"></div>
        <a class="sign_a" href="http://photo.loc/start.php">На главную</a>
        <div class="sign_wrapp">
                <h1>Регистрация</h1>
                <form method="POST" action="?signup"> 
                    <div class="row">
                        <label class="sign_label" for="email">Email:</label>
                        <input class="sign_input" name="email" id="email" autocomplete="off">
                    </div>
                    <div class="row">
                        <label class="sign_label" for="pass1">Пароль:</label>
                        <input class="sign_input" type="password" name="pass1" id="pass1">
                    </div>
                    <div class="row">
                        <label class="sign_label" for="pass2">Повтор пароля:</label>
                        <input class="sign_input" type="password" name="pass2" id="pass2">
                    </div>
                    <div class="row">
                        <label class="sign_label" for="name">Введите имя:</label>
                        <input class="sign_input" type="text" name="name" id="name">
                    </div>
                    <div class="row">
                        <label class="sign_label" for="surname">Введите фамилию:</label>
                        <input class="sign_input" type="text" name="surname" id="surname">
                    </div>
                    <div class="row">
                        <label class="sign_label" for="age">Введите возраст:</label>
                        <input class="sign_input" type="number" name="age" id="age">
                    </div>
                    <div class="row">
                        <input class="sign_input_enter" type="submit">
                </div>
            </form>
  

<?php
$usersArr = [];
// $file = fopen('users.csv', 'r');
// $buff= fgetcsv($file, 1000, ',' );
// $usersArr = $buff;  // Тут затык! идет фокус первой учетки
// fclose($file);
// как тут получать актуальные данные из массива при каждом заполнении формы?


if (isset($_POST['email']) && isset($_POST['pass1'])){ 
        if (array_search($_POST['email'], $usersArr) === false){  // что-бы не повторялись email
        if ($_POST['pass1'] === $_POST['pass2']){
            $file = fopen('users.csv', 'a');
            array_push($usersArr, $_POST['email'],$_POST['pass1'], $_POST['name'],$_POST['surname'], $_POST['age']); // пушит не в новую строку сохраняя первого введенного пользователя/ символ
            fputcsv($file, $usersArr, ','); 
            fclose($file);
            echo '<br/><br/><br/> Вы успешно зарегестрированы, вернитесь на стараницу авторизации' . PHP_EOL;

                $_SESSION['auth'] = true; // как связать документы не связывая формы, дабы сессия была доступна во всех, будет ли так работать?
               
        }
        else{
            echo 'введенные пароли не совпадают' . PHP_EOL;
        }
    }
    else {
        echo 'Веденный e-mail уже зарегестрирован' . PHP_EOL;
    }
}




// второй вариант (тоже не рабочий)
// if (!empty($_POST['email']) && !empty($_POST['pass1'])){
//     if($_POST['pass1'] === $_POST['pass1']){
//         $login = $_POST['email'];
//         $password = $_POST['pass1'];
//         $file = fopen('users.csv', 'r');
//         $data_array = fgetcsv($file, 1000, ',');// nen pfnsr
//         print_r($data_array);
//         fclose($file);
//         if (array_search($login, $data_array)>=0 && array_search($password, $data_array)>=0){
//             $file = fopen('users.csv', 'a');
//             array_push($data_array, $login, $password, $_POST['name'],$_POST['surname'], $_POST['age']);
            
//             fputcsv($file, $data_array, ',');
//             echo '<br/><br/><br/> Вы успешно зарегестрированы, вернитесь на стараницу авторизации' . PHP_EOL;
//             $_SESSION['auth'] = true;
//             fclose($file);
//         }
//         else {
//             echo 'НЕ ТО!';
//         }
        
//     }
// }


   




echo '</br></br></br> <a href="/login.php">Страница авторизации</a>';

?>

        </div>
    </main>
</div>