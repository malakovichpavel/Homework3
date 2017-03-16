<?php

$dbc = mysqli_connect('localhost', 'root', '', 'HomeWork3');
if(isset($_POST["submit"])){
   $username = mysqli_real_escape_string($dbc, trim($_POST['username']) );
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']) );
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']) );
    if(!empty($username) && !empty($password1) && !empty($password2) &&
        ($password1 == $password2)) {
        $query = "SELECT * FROM signup WHERE username = '$username'"; // кавычки ''
        $data = mysqli_query($dbc, $query);
        if(mysqli_num_rows($data) == 0) {
             $query = "INSERT INTO signup (username, password) VALUES ('$username',
              SHA('$password2'))";
             mysqli_query($dbc, $query);
             echo 'Всё готово, вы авторизованы, введите данные о себе';?>
            <p><a href="myprofile.php">Данные о себе</a> </p>
            <?php
             mysqli_close($dbc);
             exit();
        }else {
             echo 'Логин уже существует - подберите другой логин';
        }
   }
}

/*if ($dbc == false){
    echo 'не удалось подключиться к базе данных! <br>';
    echo mysqli_connect_error();
    exit();
};*/
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles1.css">
    <title>HomeWork3</title>
</head>
<body>

<div id= "blok1" >
    <ul>
        <li class="active"><a href="index.php">Авторизация</a></li>
        <li><a href="signup1.php">Регистрация</a></li>
        <li><a href="list.php">Список пользователей</a></li>
        <li><a href="filelist.php">Список файлов</a></li>
    </ul>
</div><!--/.nav-collapse -->


<content>
    <center>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <br><br><br>
    <input type="text" placeholder="Insert your login" name="username"><br><br>
    <input type="password" placeholder="Insert your password" name="password1"><br><br>
    <input type="password" placeholder="Password once more" name="password2"><br><br>
    <button name="submit"> Enter </button><br><br></form>
    </center>
</content>

<footer><center>&copy;&nbsp; 2017 All rights reserved </center></footer>
</body>
</html>