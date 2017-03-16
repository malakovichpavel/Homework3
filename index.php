<?php

$dbc = mysqli_connect('127.0.0.1', 'root', '', 'HomeWork3');
if (!isset($_COOKIE['user_id'])) {
    if (isset($_POST['submit'])) {
        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']) );
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']) );
        if(!empty($user_username) && !empty($user_password)) {
            $query = "SELECT user_id, username FROM signup WHERE 
username = '$user_username' AND password = SHA('$user_password')";
            $data = mysqli_query($dbc, $query);
            if(mysqli_num_rows($data) ==1){
                $row = mysqli_fetch_assoc($data);
                setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
                setcookie('username', $row['username'], time() + (60*60*24*30));
                $home_url = 'http://' . $_SERVER['HTTP_HOST'];
                header('Location:' . $home_url);
            }
            else {
                echo 'Введите логин и пароль правильно.';
            }

        }
        else {
            echo 'Дайте правильную информацию про логин и пароль, или зарегистрируйтесь.';
        }
    }
}

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
    <?php
    if(empty($_COOKIE['username'])) {

        ?>

        <center>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <br><br><br>
            <input type="text" placeholder="Login" name="username"><br><br>
            <input type="password" placeholder="Password" name="password1"><br><br>
            <button type="submit" name="submit">Enter</button>
            <br><br>
            <a href="signup1.php">Registration</a></form> <br><br>
        </center>
        <?php
    }
    else {
    ?>
        <p><a href="myprofile.php">Данные о себе</a> </p>
        <p><a href="exit.php">Выход</a> </p>
        <?php
        echo 'cookie exist.';
    }
    ?>
</content>
<?php
mysqli_close($dbc);
?>
<footer><center>&copy;&nbsp; 2017 All rights reserved </center></footer>
</body>
</html>