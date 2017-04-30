<?php

//$conn = mysqli_connect('127.0.0.1', 'root', '', 'HomeWork3');

require_once 'login.php';
$dbc = new mysqli($hn, $un, $pw, $db);
if(isset($_POST["submit"])){

   // $user_id = mysqli_real_escape_string($dbc, trim($_POST['$user_id']) );

    //$query = "INSERT INTO info(user_id) SELECT 'user_id' FROM signup";

    $name = mysqli_real_escape_string($dbc, trim($_POST['name']) );
    $age = mysqli_real_escape_string($dbc, trim($_POST['age']) );
    $description = mysqli_real_escape_string($dbc, trim($_POST['description']) );
    //$userid = setcookie('user_id');
    $userid = $_COOKIE['user_id'];
    //$user     = $_COOKIE['user_id'];

            $query = "INSERT INTO info (name, age, description, user_id) VALUES ('$name', '$age', '$description', '$user_id')";
            mysqli_query($dbc, $query);
            echo 'Всё готово, данные о себе введены, а теперь загрузите фото для аватара';?>
            <p><a href="foto.php">Загрузить фото для аватара</a> </p>
            <?php
            mysqli_close($dbc);
            exit();
}
//"SELECT FROM info WHERE user_id='user_id'"
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles1.css">
    <title>HomeWork3</title>
</head>
<body>
<center>
<div id= "blok1" >
    <a href="index.php">-Авторизация-  </a>
    <a href="signup1.php">-Регистрация-  </a>
    <a href="list.php">-Список пользователей-  </a>
    <a href="filelist.php">-Список файлов-  </a>
</div>
    </center>

<content>
    <center>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <br><br><br>
    <input type="text" placeholder="Insert your name" name="name"><br><br>
    <input type="text" placeholder="Insert your age" name="age"><br><br>
    <input type="text" placeholder="Insert description" name="description"><br><br>
    <button name="submit"> Enter </button><br><br></form>
    </center>
</content>

<footer><center>&copy;&nbsp; 2017 All rights reserved </center></footer>
</body>
</html>


