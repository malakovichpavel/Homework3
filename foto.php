
<?php
require_once 'login.php';
$dbc = new mysqli($hn, $un, $pw, $db);

$path = 'img/'; // директория для загрузки
//$ext = array_pop(explode('.',$_FILES['myfile']['foto_name'])); // расширение
$ext = pathinfo($_FILES['myfile']['foto_name'], PATHINFO_EXTENSION);
$new_name = time().'.'.$ext; // новое имя с расширением
$full_path = $path.$new_name; // полный путь с новым именем и расширением

if($_FILES['myfile']['error'] == 0){
    if(move_uploaded_file($_FILES['myfile']['tmp_name'], $full_path)){
        // Если файл успешно загружен, то вносим в БД

           /* $new_name = mysqli_real_escape_string($dbc, trim($_POST['new_name']) );*/ // экранизация для безопасности

            $query = "INSERT INTO info (foto_name) VALUES ('$new_name')";
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
            exit();


        // Можно сохранить $full_path (полный путь) или просто имя файла - $new_name
    }
}

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

                <form method="post" enctype="multipart/form-data">
                    <p>
                        <label>
                            <input type="file" name="myfile" id="myfile">
                        </label>
                    </p>
                    <p>
                        <input type="submit" name="submit" id="submit" value="Отправить">
                    </p>
                </form>

        </center>
    </content>

    <footer><center>&copy;&nbsp; 2017 All rights reserved </center></footer>
    </body>

    </html>