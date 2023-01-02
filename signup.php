<link rel="stylesheet" href="./style.css">

<h1>Регистрация</h1>
<form method="POST" action="?signup"> 
    <div class="row">
        <label for="email">Email:</label>
        <input name="email" id="email" autocomplete="off">
    </div>
    <div class="row">
        <label for="pass1">Пароль:</label>
        <input type="password" name="pass1" id="pass1">
    </div>
    <div class="row">
        <label for="pass2">Повтор пароля:</label>
        <input type="password" name="pass2" id="pass2">
    </div>
    <div class="row">
        <label for="name">Введите имя:</label>
        <input type="text" name="name" id="name">
    </div>
    <div class="row">
        <label for="surname">Введите фамилию:</label>
        <input type="text" name="surname" id="surname">
    </div>
    <div class="row">
        <label for="age">Введите возраст:</label>
        <input type="number" name="age" id="age">
    </div>
    <div class="row">
        <input type="submit">
    </div>
</form>


<?php

$usersArr = [];

if (isset($_POST['email']) && isset($_POST['pass1'])){
    if (array_search($_POST['email'], $usersArr) === false){ // что-бы не повторялись email
        if ($_POST['pass1'] === $_POST['pass2']){
            $file = fopen('users.csv', 'a');
            array_push($usersArr, $_POST['email'],$_POST['pass1'], $_POST['name'],$_POST['surname'], $_POST['age']);
            fputcsv($file, $usersArr, ','); // записываем данные в файл из него потом будет сверять наличие данных аналогично стр.29
            fclose($file);
            echo '<br/><br/><br/> Вы успешно зарегестрированы, вернитесь на стараницу авторизации' . PHP_EOL;
        }
        else{
            echo 'введенные пароли не совпадают' . PHP_EOL;
        }
    }
}

echo '<a href="/login.php">Страница авторизации</a>';
