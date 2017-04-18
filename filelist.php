<?php
session_start();

$userstr = '(Guest)';
$loggedin = FALSE;
if (isset($_COOKIE['user_id']))
{
    $user     = $_COOKIE['user_id'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
}
//else $loggedin = FALSE;

if ($loggedin)
{
    echo "<br ><ul>" .
        "<span>&#8658; Вы зарегистрированы - можете пользоваться ресурсом.</span><br><br>";
}
else
{
    echo ("<br><ul class='menu'>" .
        "<li><a href='signup.php'>Регистрация</a></li>"            .
        "<li><a href='index.php'>Авторизация</a></li></ul><br>"     .
        "<span>&#8658; Ты должен быть зарегистрирован и авторизован " .
        "чтобы просматривать эту страницу.</span><br><br>");
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
<center>
<div id= "blok1" >
    <a href="index.php">-Авторизация-  </a>
    <a href="signup1.php">-Регистрация-  </a>
    <a href="list.php">-Список пользователей-  </a>
    <a href="filelist.php">-Список файлов-  </a>
</div><!--/.nav-collapse -->

    <div>
        <h2>Запретная зона, доступ только авторизированному пользователю</h2>
        <h2>Информация выводится из списка файлов</h2>
        <table class="table1">
            <tr>
                <th>Название файла</th>
                <th>Фотография</th>
                <th>Действия</th>
            </tr>
            <tr>
                <td>

                    <?php
                    require_once 'login.php';
                    $conn = new mysqli($hn, $un, $pw, $db);


                    // загрузка foto_name из бд

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
                            echo $row['foto_name'].'<br />';
                            ?>
                        </center> </div>
                    <?php
                    } $result->close();
                    ?>
                </td>

                <td>
                    <?php

                    // загрузка фото из папки

                    $wimage = "";
                    $fimg = "";
                    $path = "img/"; // задаем путь до сканируемой папки с изображениями
                    $images = scandir($path); // сканируем папку
                    if ($images !== false) { // если нет ошибок при сканировании
                        $images = preg_grep("/\.(?:png|gif|jpe?g)$/i", $images); // через регулярку создаем массив только изображений
                        if (is_array($images)) { // если изображения найдены
                            foreach($images as $image) { // делаем проход по массиву
                                $fimg .= "<img src='".$path.htmlspecialchars(urlencode($image))."' alt='".$image."'\" width=\"50\" /><br/>";
                            }
                            $wimage .= $fimg;
                        } else { // иначе, если нет изображений
                            $wimage .= "<div style='text-align:center'>Не обнаружено изображений в директории!</div>\n";
                        }
                    } else { // иначе, если директория пуста или произошла ошибка
                        $wimage .= "<div style='text-align:center'>Директория пуста или произошла ошибка при сканировании.</div>";
                    }
                    echo $wimage; // выводим полученный результат


                    /*$arr = scandir('./');
                    foreach($arr as $v) {
                        if(stripos($v,'.jpg'))
                            echo '<img src="'.$v.'" width="100" hegiht="100" />';
                    }*/
                    ?>

                    <!--<img src="http://lorempixel.com/people/100/100/" alt=""></td>-->

                <td>
<?php

// Удалить пользователя

$query = "SELECT * FROM signup";
$result = $conn->query($query);
if(!$result) die($conn->error);

for($i = 0, $lenght = $result->num_rows; $i < $lenght; $i++){
    $result->data_seek($i);
    $row = $result->fetch_assoc();
    ?>
    <div><center>


            <form action="del.php" method=post><input
                        name='user_id' value="<?php echo $row['user_id']; ?>">
                <input value="Удалить пользователя" type="submit" name="submit"></form>


        </center> </div>
    <?php
} $result->close();?>


                </td>
            </tr>
        </table>

    </div><!-- /.container -->
    <footer><center><br><br><br><br>&copy;&nbsp; 2017 All rights reserved </center></footer>
    </center>