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
    $usersArrToRead = (fgetcsv($file, 1000, ',')); 
    fclose($file);

// проверочная часть
    // print_r($usersArrToRead);
    // print_r ($var);
    // echo gettype(array_search($_POST['email'],$usersArrToRead));
    // if (gettype (array_search($_POST['email'],$usersArrToRead)) === 'integer'){
    //     echo '<br/><br/>Работает   - ' . array_search($_POST['email'],$usersArrToRead);
    // }
    // else{
    //     echo '<br/><br/>НЕ работает   - ' . array_search($_POST['email'],$usersArrToRead);
    // }
    
    if(gettype(array_search($_POST['email'],$usersArrToRead)) === 'integer' && gettype(array_search($_POST['pass'],$usersArrToRead)) === 'integer'){  // не получается создать условие через empty/isset
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
elseif($_SESSION['auth'] === false ){  /// это условие не рабочее, не добился его вызова, плюс сыпет ошибку если сессия не начата, как ее скрыть?
    echo '<br/><br/>Заполните корректно данные для входа';
}

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) { 
    echo "Личный кабинет <script> window.location = 'personal.php';</script>";
}

// В какой момент необходимо закрыть сессию?