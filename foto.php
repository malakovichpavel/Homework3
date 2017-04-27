
<?php
require_once 'login.php';
$dbc = new mysqli($hn, $un, $pw, $db);
require_once 'check.php'; // подключаем файл проверки, обязательно после подключения к базе

if (!$loggined) { // если проверка не пройдена, то перенаправляем на страницу логина
    header('Location: index.php');
}


$path = 'img/'; // директория для загрузки
$ext = pathinfo($_FILES['myfile']['name'], PATHINFO_EXTENSION); // расширение
$new_name = time().'.'.$ext; // новое имя с расширением
$full_path = $path.$new_name; // полный путь с новым именем и расширением

if($_FILES['myfile']['error'] == 0){
    if(move_uploaded_file($_FILES['myfile']['tmp_name'], $full_path)){
        // Если файл успешно загружен, то вносим в БД
        $query = "SELECT * FROM info WHERE user_id = '$user_id'"; // переменная $user_id берётся из куков в файле check.php
        $data = mysqli_query($dbc, $query);
        if(mysqli_num_rows($data) != 0) { // если для данного пользователя уже есть запись в таблице инфо, то обновляем её
            $row = mysqli_fetch_assoc($data);
            $query = "UPDATE `info` SET `foto_name` = '$new_name' WHERE `info_id` = ".$row['info_id'];
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
        } else { // если же нет, то создаём новую
            $query = "INSERT INTO info (`user_id`, `foto_name`) VALUES ('$user_id', '$new_name')"; // нужно обязательно
            // указывать для какого пользователя эта картинка!!!
            mysqli_query($dbc, $query);
            mysqli_close($dbc);
            echo ' всё успешно загружено';
            //exit(); - эксит тут лишний, лучше вывести сообщение, что всё успешно загружено
        }
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