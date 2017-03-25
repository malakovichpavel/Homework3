<?php

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
                    <?php // Вывод содержимого таблицы signup
                    require_once 'login.php';
                    $conn = new mysqli($hn, $un, $pw, $db);
                    if (mysqli_connect_errno()) {
                        die (mysqli_connect_error());
                    }

                    $query = "SELECT * FROM signup";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    for($i = 0, $lenght = $result->num_rows; $i < $lenght; $i++){
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
                    <!--vasya99-->
                </td>
                <td>

                    <?php
                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    for($i = 0, $lenght = $result->num_rows; $i < $lenght; $i++){
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

                    <!--Вася-->
                </td>
                <td>
                    <?php
                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    for($i = 0, $lenght = $result->num_rows; $i < $lenght; $i++){
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

                    <!--14-->
                </td>
                <td>
                    <?php
                    $query = "SELECT * FROM info";
                    $result = $conn->query($query);
                    if(!$result) die($conn->error);

                    for($i = 0, $lenght = $result->num_rows; $i < $lenght; $i++){
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

                    <!--Эксперт в спорах в интернете-->
                </td>
                <td><img src="http://lorempixel.com/people/200/200/" alt=""></td>
                <td>
                    <a href="">Удалить пользователя</a>
                </td>
            </tr>
        </table>



    </div><!-- /.container -->
    <footer><center><br><br><br><br>&copy;&nbsp; 2017 All rights reserved </center></footer>
</center>