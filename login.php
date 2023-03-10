<?php
require_once __DIR__ . '\logger.php';  //new
use photo_project\Logger; //new
$logger = new Logger;



session_start();
?>

<link rel="stylesheet" href="./style.css">
<div class="back">
    <div class="wrapper">      
        <main>
            <div class="sign_wrapp">
                <h1> Вход </h1>
                <form method="POST" action="/login.php"> 
                    <div class="row_signup">
                        <label class="login_label" for="email">Email:</label>
                        <input class="login_input" name="email" id="email" autocomplete="off">
                    </div>
                    <div class="row_signup">
                        <label class="login_label" for="pass">Пароль:</label>
                        <input class="login_input" type="password" name="pass" id="pass">
                    </div>
                    <div class="row_signup">
                        <!-- <a href="?recovery">Забыли пароль?</a> -->
                        <a href="/signup.php">Регистрация</a>
                    </div>
                    <div class="row_signup">
                        <input class="login_input_enter" type="submit"></br></br>
                    </div>
                </form>

<?php
if (isset($_POST['email']) && isset($_POST['pass'])){
    $file = fopen('users.csv', 'r');

    $logg = [];
    while (($userData = fgetcsv($file)) != false){ // из файла формирует массив и бежит по строкам (данным - учетной записи) пока не увидит пустую строку т.е. файл закончился (перебрал базу)
        if ($_POST['email'] === $userData[0] && password_verify($_POST['pass'], $userData[1]) === true){ 
            $logg = $userData; // залогированный пользователь
        }
    }
    fclose($file);

    if (count($logg)!=0){
            $_SESSION['email'] = $logg[0];
            $_SESSION['user'] = $logg[2];
            $_SESSION['auth'] = true;  
    }

    if (!isset($_SESSION['auth'])){ 
        echo '<br/><br/> Заполните данные корректно если Вы не регестрировались - пройдите регистрацию'; 
    }
    else{
        echo '<br/><br/>Добро пожаловать' . $_SESSION['user'];  
    } 
}
elseif (!isset($_POST)){  
    
    echo '<br/><br/>Заполните корректно данные для входа';
}

if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
    $logger->recordToFile('Авторизирован пользователь с email: ' . $_SESSION['email']);
    header('Location: personal.php?directory=' . $_SESSION['email']); 
}





?>

            </div>
        </main>
    </div>
</div> 