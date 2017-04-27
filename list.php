<?php
session_start();

$userstr = ' (Guest)';

if (isset($_SESSION['user']))
{
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
else $loggedin = FALSE;

if ($loggedin)
{
    echo "<br ><ul>" .
        "<span class='info'>&#8658; Вы зарегистрированы - можете пользоваться ресурсом.</span><br><br>";
}
/*else
{
    header('Location: index.php');
}*/

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
</div><!--/.nav-collapse -->

    <div>
        <h2>Запретная зона, доступ только авторизированному пользователю</h2>
        <h2>Информация выводится из базы данных</h2>
        <table class="table1">
            <tr>
                <th class="table1">Пользователь(логин)</th>
                <th class="table1">Имя</th>
                <th class="table1">возраст</th>
                <th class="table1">описание</th>
                <th class="table1">Фотография</th>
                <th class="table1">Действия</th>
            </tr>
            <tr>
                <td>
                    <?php

                    // Вывод содержимого таблицы signup
                    require_once 'login.php';
                    $conn = new mysqli($hn, $un, $pw, $db);
                    if (mysqli_connect_errno()) {
                        die (mysqli_connect_error());
                    }

                    // загрузка username из signup

                    $query = "SELECT * FROM signup";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);
                    $lenght = $result->num_rows;
                    for($i = 0; $i < $lenght; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="table1"><center>
                            <?php
                            echo $row['username'].'<br />';
                            ?>
                            </center> </div>
                    <?php
                    } $result->close();
                    ?>
                </td>
                <td>
                    <?php

                    // загрузка name

                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    $lenght = $result->num_rows;
                    for($i = 0; $i < $lenght; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="table1"><center>
                                <?php
                                echo $row['name'].'<br />';
                                ?>
                            </center> </div>
                        <?php
                    } $result->close();
                    ?>

                </td>
                <td>
                    <?php

                    // загрузка age

                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);
                    $lenght = $result->num_rows;
                    for($i = 0; $i < $lenght; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="table1"><center>
                                <?php
                                echo $row['age'].'<br />';
                                ?>
                            </center> </div>
                        <?php
                    } $result->close();
                    ?>

                </td>
                <td>
                    <?php

                    // загрузка description

                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);
                    $lenght = $result->num_rows;
                    for($i = 0;  $i < $lenght; $i++) {
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="table1"><center>
                                <?php
                                echo $row['description'].'<br />';
                                ?>
                            </center> </div>
                        <?php
                    } $result->close();
                    ?>

                </td>

                <td>
                    <?php

                    // загрузка фото из папки

                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);
                    $lenght = $result->num_rows;
                    for($i = 0;  $i < $lenght; $i++) {
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();
                        ?>
                        <div class="table1"><center>
                                <img src="img/'foto_name'"/>
                            </center> </div>
                        <?php
                    } $result->close();
                    ?>
                    <!-- <img src="http://lorempixel.com/people/100/100/" alt="">-->
                </td>
                <td>
                    <?php

                    // Удалить пользователя

                    $query = "SELECT * FROM signup";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);
                    $lenght = $result->num_rows;
                    for($i = 0; $i < $lenght; $i++){
                        $result->data_seek($i);
                        $row = $result->fetch_assoc();
                        ?>
                        <div><center>

                                <form action="del.php" method=post><input
                                            name='user_id' value="<?php echo $row['user_id']; ?>">
                                    <input value="Удалить пользователя" type="submit" name="submit"></form>

                                <!-- <a href="del.php?user_id=<//?php echo $row['user_id']; ?>">Удалить пользователя</a>-->

                            </center> </div>
                        <?php
                    } $result->close();

                    ?>

                </td>
            </tr>
        </table>



    </div><!-- /.container -->
    <footer><center><br><br><br><br>&copy;&nbsp; 2017 All rights reserved </center></footer>
</center>