
<?php

/*require_once 'login.php';
$dbc = new mysqli($hn, $un, $pw, $db);
if(isset($_POST["submit"])){
    $foto_name = mysqli_real_escape_string($dbc, trim($_POST['foto_name']) );

    $query = "INSERT INTO foto (foto_name) VALUES ('$foto_name')";
    mysqli_query($dbc, $query);
    mysqli_close($dbc);
    exit();
}*/

$imgDir = "img";        // каталог для хранения изображений
@mkdir($imgDir, 0777);  // создаем, если его еще нет
// Проверяем, нажата ли кнопка добавления фотографии.
if (@$_REQUEST['doUpload']) {
    $data = $_FILES['file'];
    $tmp = $data['tmp_name'];
    // Проверяем, принят ли файл.
    if (is_uploaded_file($tmp)) {
        $info = @getimagesize($tmp);
        // Проверяем, является ли файл изображением.
        if (preg_match('{image/(.*)}is', $info['mime'], $p)) {
            // Имя берем равным текущему времени в секундах, а
            // расширение - как часть MIME-типа после "image/".
            $name = "$imgDir/".time().".".$p[1];
            // Добавляем файл в каталог с фотографиями.
            move_uploaded_file($tmp, $name);
        } else {
            echo "<h2>Попытка добавить файл недопустимого формата!</h2>";
        }
    } else {
        echo "<h2>Ошибка закачки #{$data['error']}!</h2>";
    }
}
// Теперь считываем в массив наш фотоальбом.
$photos = array();
foreach (glob("$imgDir/*") as $path) {
    $sz = getimagesize($path); // размер
    $tm = filemtime($path);    // время добавления
    // Вставляем изображение в массив $photos.
    $photos[$tm] = [
        'time' => $tm,              // время добавления
        'name' => basename($path),  // имя файла
        'url'  => $path,            // его URI
        'w'    => $sz[0],           // ширина картинки
        'h'    => $sz[1],           // ее высота
        'wh'   => $sz[3]            // "width=xxx height=yyy"
    ];
}
// Ключи массива $photos - время в секундах, когда была добавлена
// та или иная фотография. Сортируем массив: наиболее "свежие"
// фотографии располагаем ближе к его началу.
krsort($photos);
// Данные для вывода готовы. Дело за малым - оформить страницу.

?>
    <!DOCTYPE html>
    <html lang='ru'>
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

                <form action="<?=$_SERVER['SCRIPT_NAME']?>" method="POST" enctype="multipart/form-data">
                    <input type="file" name="file"><br>
                    <input type="submit" name="doUpload" value="Закачать новую фотографию">

                </form>
                <?php foreach($photos as $n=>$img) {?>
                <p><img
                            src="<?=$img['url']?>"
                        <?=$img['wh']?>
                            alt="Добавлена <?=date("d.m.Y H:i:s", $img['time'])?>"
                    >
                    <?php } ?>
                <br><br><br>
        </center>
    </content>

    <footer><center>&copy;&nbsp; 2017 All rights reserved </center></footer>
    </body>

    </html>