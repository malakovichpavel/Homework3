<?php
$loggined = false;
$username = null;
$user_id = 0;

if (isset($_COOKIE['user_id'])) { // проверяем, есть ли у нас куки
	$user_id = (int)$_COOKIE['user_id']; // если есть, то приводим к типу интеджер,
    // чтобы защитить от подложный данных, так как айди может быть только целочисленным
	$query = "SELECT * FROM signup WHERE user_id = '$user_id'"; // запрашиваем в базе данные по текущему пользователю
	$data = mysqli_query($dbc, $query);
	if(mysqli_num_rows($data) != 0) { // если такие данные есть, то сравниваем пароли
		$row = mysqli_fetch_assoc($data);
		if ($row['password'] == $_COOKIE['password']) { // если пароль в куках и пароль в базе равны, значит всё хорошо
			$loggined = true;
			$username = $row['username']; // сохраняем имя пользователя чтоб оно было доступно на остальных страницах, куда подключен этот скрипт
		}
	} else {
		echo 'нету в базе ни шиша';
	}

} else {
	echo 'нема куков';
}