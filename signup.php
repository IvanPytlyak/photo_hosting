<?php
session_start();
?>

<link rel="stylesheet" href="./style.css">

<div class="back">
    <div class="wrapper">
        <main>
            <a class="sign_a" href="http://photo.loc/start.php">На главную</a>
            <div class="sign_wrapp">
                <h1>Регистрация</h1>
                <form method="POST" action="?signup"> 
                        <div class="row_signup">
                            <label class="sign_label" for="email">Email:</label>
                            <input class="sign_input" name="email" id="email" autocomplete="off">
                        </div>
                        <div class="row_signup">
                            <label class="sign_label" for="pass1">Пароль:</label>
                            <input class="sign_input" type="password" name="pass1" id="pass1">
                        </div>
                        <div class="row_signup">
                            <label class="sign_label" for="pass2">Повтор пароля:</label>
                            <input class="sign_input" type="password" name="pass2" id="pass2">
                        </div>
                        <div class="row_signup">
                            <label class="sign_label" for="name">Введите имя:</label>
                            <input class="sign_input" type="text" name="name" id="name">
                        </div>
                        <div class="row_signup">
                            <label class="sign_label" for="surname">Введите фамилию:</label>
                            <input class="sign_input" type="text" name="surname" id="surname">
                        </div>
                        <div class="row_signup">
                            <label class="sign_label" for="age">Введите возраст:</label>
                            <input class="sign_input" type="number" name="age" id="age">
                        </div>
                        <div class="row_signup">
                            <input class="sign_input_enter" type="submit">
                    </div>
                </form>
    

<?php

$usersArr = [];
$file = fopen('users.csv', 'r');
if (!empty($_POST['email'])){
while (($userData = fgetcsv($file)) != false){ // проход по массиву файла user.csv по строчно, где строка - элеменнт массива
    if ($_POST['email'] === $userData[0]){ 
        echo 'Такой email уже зарегестрирован';
        exit;
    }
}
}
fclose($file);

// users.csv in gitignore                    

if (isset($_POST['email']) && isset($_POST['pass1'])){ 
    $pattern =  '/[a-zA-Z0-9!@#\$%&?\-+=~]*$/i';
    preg_match($pattern, $_POST['email'], $matches_email);
    if ($_POST['email'] !=  $matches_email[0]){  // && $_POST['pass1'] != $matches_pass[0] - не работает, связано ли это с солью?
        echo 'Введен недопустимый символ ';
    }
    else{ 
        if(strlen($_POST['email'])>=6 && strlen($_POST['email'])<=16 && strlen($_POST['pass1'])>=6 && strlen($_POST['pass1'])<=16){
                    if ($_POST['pass1'] === $_POST['pass2']){
                        $file = fopen('users.csv', 'a');
                        array_push($usersArr, $_POST['email'], password_hash($_POST['pass1'], PASSWORD_DEFAULT), $_POST['name'],$_POST['surname'], $_POST['age']); // пушит не в новую строку сохраняя первого введенного пользователя/ символ
                        fputcsv($file, $usersArr, ','); 
                        fclose($file);
                        echo '<br/><br/><br/> Вы успешно зарегестрированы, вернитесь на стараницу авторизации.' . PHP_EOL;
                        $_SESSION['auth'] = true;     
                    }
                    else{   
                        //если логин или пароль вбиты некорректно, над соответствующим инпутом выводилось сообщение об этом - как это реализуется? через SESSION
                        echo '<br/><br/><br/> Введенные пароли не совпадают.' . PHP_EOL;
                    }  
        }
        else {
            echo '<br/><br/><br/> Длина пароля/email-a должна быть более 6 символов, но менее 12.' . PHP_EOL;
        }
    }
}


// if (isset($_POST['email']) && isset($_POST['pass1'])){ 
//     if (array_search($_POST['email'], $usersArr) === false){// что-бы не повторялись email
//         if(strlen($_POST['email'])>=6 && strlen($_POST['email'])<=12){
//             if (strlen($_POST['pass1'])>=6 && strlen($_POST['pass1'])<=12){
//                 if ($_POST['pass1'] === $_POST['pass2']){
//                     $file = fopen('users.csv', 'a');
//                     array_push($usersArr, $_POST['email'],$_POST['pass1'], $_POST['name'],$_POST['surname'], $_POST['age']); // пушит не в новую строку сохраняя первого введенного пользователя/ символ
//                     fputcsv($file, $usersArr, ','); 
//                     fclose($file);
//                     echo '<br/><br/><br/> Вы успешно зарегестрированы, вернитесь на стараницу авторизации' . PHP_EOL;

//                     $_SESSION['auth'] = true; // как связать документы не связывая формы, дабы сессия была доступна во всех, будет ли так работать?
                    
//                 }
//                 else{
//                     // $_SESSION['error_msg'] = 'Неверный пароль или логин'; // как это работает и зачем нужно?
//                     //если логин или пароль вбиты некорректно, над соответствующим инпутом выводилось сообщение об этом - как это реализуется?
//                     echo '<br/><br/><br/> Введенные пароли не совпадают' . PHP_EOL;
//                 }
//             }
//             else {
//                 echo '<br/><br/><br/> Длина пароля должна быть более 6 символов, но менее 12' . PHP_EOL;
//             }    
//         }
//         else {
//             echo '<br/><br/><br/> Email заполнен не корректно' . PHP_EOL;
//         }
//     }
//     else {
//         echo '<br/><br/><br/> Веденный e-mail уже зарегестрирован' . PHP_EOL;
//     }
// }


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



// $arr_en = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
// //generation = chr + iterator?
// $arr_EN = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
// $arr_num = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
// $arr_symb = ['!', '@', '#', '$', '%', '&', '?', '-', '+', '=', '~'];
// $arr_to_search =['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, '!', '@', '#', '$', '%', '&', '?', '-', '+', '=', '~'];

// $pattern =  '/[a-zA-Z0-9!@#\$%&?\-+=~]*/$/i/';
// $pattern = '/[a-zA-Z0-9!@#$%&?\-+=~]+$/i';
// if (preg_match($pattern, $_POST['email']) === 0 || preg_match($pattern, $_POST['pass1']) === 0){ // возвращает всегда 1
//     echo '<br/><br/><br/> Введенный символ не допустим в поле email/password' . PHP_EOL;  // как вставить ошибочный символ аналогично  стр 69  - $_POST['email'][$i]
// }
// pregmatch_all -> count = count post[email]
// не работает
   
// for ($i=0; $i<strlen($_POST['email']); $i++){ // писали вместе
//     $pattern =  'a-zA-Z0-9!@#$%&?\-+=~';
//     if (strpos($pattern, $_POST['email'][$i]) === false){
//         echo '<br/><br/><br/> Введенн недопустимый символ в поле email/password.' . PHP_EOL; // почистить $i '. $_POST['email'][$i] .'
//         exit;
//     }
// }    


// if (isset($_POST['email'])){
//         $pattern =  '/[a-zA-Z0-9!@#\$%&?\-+=~]*$/i';
//         preg_match($pattern, $_POST['email'], $matches_email);
//         if ($_POST['email'] !=  $matches_email[0]){  // && $_POST['pass1'] != $matches_pass[0] - не работает, связано ли это с солью?
//             echo 'Введен недопустимый символ ';
//         }
//         else{
//             echo 'все ок';
//         }
//     }



echo '</br></br></br> <a href="/login.php">Страница авторизации</a>';

?>

            </div>
        </main>
    </div>   
</div>