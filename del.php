<?php
require_once 'login.php'; // подключаем скрипт
$dbc = new mysqli($hn, $un, $pw, $db);

if(isset($_POST["submit"])){
    $user_id = mysqli_real_escape_string($dbc, trim($_POST['$user_id']) );


$query = "DELETE FROM info WHERE id = '$user_id'";
$result = $conn->query($query);

mysqli_close($dbc);
exit();
}
?>