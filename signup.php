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
                

if (isset($_POST['email']) && isset($_POST['pass1'])){ 
    $pattern =  '/[a-zA-Z0-9!@#\$%&?\-+=~]*$/i';
    preg_match($pattern, $_POST['email'], $matches_email);
    if ($_POST['email'] !=  $matches_email[0]){  
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

echo '</br></br></br> <a href="/login.php">Страница авторизации</a>';

?>

            </div>
        </main>
    </div>   
</div>