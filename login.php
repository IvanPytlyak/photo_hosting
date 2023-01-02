<link rel="stylesheet" href="./style.css">
<h1> Вход </h1>
<form method="POST" action="/login.php"> 
    <div class="row">
        <label for="email">Email:</label>
        <input name="email" id="email" autocomplete="off">
    </div>
    <div class="row">
        <label for="pass">Пароль:</label>
        <input type="password" name="pass" id="pass">
    </div>
    <div class="row">
        <!-- <a href="?recovery">Забыли пароль?</a> -->
        <a href="/signup.php">Регистрация</a>
    </div>
    <div class="row">
        <input type="submit"></br></br>
    </div>
</form>

<?php


if (isset($_POST['email']) && isset($_POST['pass'])){
    $file = fopen('users.csv', 'r');
    $usersArrToRead = (fgetcsv($file, 1000, ',')); // тут что-то не так с типизацией данных, можно брать готовый массив из signup.php но при связи страниц будет видно отображение 2-х форм, а этого хочется избежать 
    print_r($usersArrToRead);
    fclose($file);
    if(!empty(array_search($_POST['email'],$usersArrToRead)) && !empty(array_search($_POST['pass'],$usersArrToRead))){  
            session_start();
            $_SESSION['email'] = $_POST['email'];
            // $_SESSION['user']=$_POST['user']; // как присвоить для аккаунта userName нужно сопоставимость строка в csv-файле = один user, как этого достичь?
            $_SESSION['auth'] = true;  
    }
    if (!isset($_SESSION['auth'])){
        echo '<br/><br/> Заполните данные корректно если Вы не регестрировались - пройдите регистрацию';
    }
    else{
        echo '<br/><br/>Добро пожаловать ';  // . $_SESSION['user'];
    } 
}
elseif($_SESSION['auth'] === false ){ // тут сессия не определенаб не работает
    echo '<br/><br/>Заполните корректно данные для входа';
}

if (isset($_SESSION['auth']) || $_SESSION['auth'] === true) { // тут сессия не определенаб не работает
    echo '<br/><a href="/personal.php"> Личный кабинет </a>';
}