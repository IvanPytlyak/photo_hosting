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

// $arr_en = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
// //generation = chr + iterator?
// $arr_EN = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
// $arr_num = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
// $arr_symb = ['!', '@', '#', '$', '%', '&', '?', '-', '+', '=', '~'];
// $arr_to_search =['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z','A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, '!', '@', '#', '$', '%', '&', '?', '-', '+', '=', '~'];


// $pattern = '/[a-zA-Z]*[0-9]*[!,@,#,$,%,&,?,-,+,=,~]*$/i';
// if (preg_match($pattern, $_POST['email']) === 0 || preg_match($pattern, $_POST['pass1']) === 0){ // возвращает всегда 1
//     echo '<br/><br/><br/> Введенный символ не допустим в поле email/password' . PHP_EOL;  // как вставить ошибочный символ аналогично  стр 69  - $_POST['email'][$i]
// }
// не работает



$usersArr = [];
// $file = fopen('users.csv', 'r');
// $buff= fgetcsv($file, 1000, ',' );
// $usersArr = $buff;  // Тут затык! идет фокус первой учетки
// fclose($file);
// как тут получать актуальные данные из массива при каждом заполнении формы?


// if (isset($_POST['email'])){
//     for ($i=0; $i<count(str_split($_POST['email'], 1)); $i++){
        // if (in_array(str_split($_POST['email'][$i]), $arr_to_search) === false){
        //     echo '<br/><br/><br/> Введенный символ' . $_POST['email'][$i] .  'не допустим в поле email' . PHP_EOL;
        // }
// }
// }

                        // Выходит очень длинная череда if-ов есть альтернатива?

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


if (isset($_POST['email']) && isset($_POST['pass1'])){ 
    if (array_search($_POST['email'], $usersArr) === false){// что-бы не повторялись email
        if(strlen($_POST['email'])>=6 && strlen($_POST['email'])<=12){
            if (strlen($_POST['pass1'])>=6 && strlen($_POST['pass1'])<=12){
                if ($_POST['pass1'] === $_POST['pass2']){
                    $file = fopen('users.csv', 'a');
                    array_push($usersArr, $_POST['email'], password_hash($_POST['pass1'], PASSWORD_DEFAULT), $_POST['name'],$_POST['surname'], $_POST['age']); // пушит не в новую строку сохраняя первого введенного пользователя/ символ
                    fputcsv($file, $usersArr, ','); 
                    fclose($file);
                    echo '<br/><br/><br/> Вы успешно зарегестрированы, вернитесь на стараницу авторизации' . PHP_EOL;

                    $_SESSION['auth'] = true; // как связать документы не связывая формы, дабы сессия была доступна во всех, будет ли так работать?
                    
                }
                else{
                    // $_SESSION['error_msg'] = 'Неверный пароль или логин'; // как это работает и зачем нужно?
                    //если логин или пароль вбиты некорректно, над соответствующим инпутом выводилось сообщение об этом - как это реализуется?
                    echo '<br/><br/><br/> Введенные пароли не совпадают' . PHP_EOL;
                }
            }
            else {
                echo '<br/><br/><br/> Длина пароля должна быть более 6 символов, но менее 12' . PHP_EOL;
            }    
        }
        else {
            echo '<br/><br/><br/> Email заполнен не корректно' . PHP_EOL;
        }
    }
    else {
        echo '<br/><br/><br/> Веденный e-mail уже зарегестрирован' . PHP_EOL;
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