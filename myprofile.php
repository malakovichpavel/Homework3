<?php

$prof = mysqli_connect('127.0.0.1', 'root', '', 'HomeWork3');

if (isset($_POST['name']) &&
    isset($_POST['age']) &&
    isset($_POST['description']))
{
    $name = get_post($conn, 'name');
    $age = get_post($conn, 'age');
    $description = get_post($conn, 'description');


    $query = "INSERT INTO info VALUES" . "('$name', '$age', '$description')";
    $result = $conn->query($query);
    if (!$result) echo "Сбой при вставке данных: $query<br>" . $conn->error . "<br><br>";
}

echo <<<_END
<form action="sqltest.php" method="post"><pre>
Имя <input type="text" name="author">
Возраст <input type="text" name="title">
Описание <input type="text" name="category">
<input type="submit" value="Добавить данные"> 
</pre></form>
_END;

$query = "SELECT * FROM info";
$result = $conn->query($query);
if (!$result) die ("Сбой при доступе к базе данных: " . $conn->error);

$rows = $result->num_rows;

for ($j = 0 ; $j < $rows ; ++$j)
{
    $result->data_seek($j);
    $row = $result-> fetch_arrow(MYSQLI_NUM);

    echo <<<_END
<pre>
Имя $row[0]
Возраст $row[1]
Описание $row[2]

</pre>
<form action="myprofile.php" method="post">
<input type="hidden" name="delete" value="yes">

<input type="submit" value="DELETE RECORD"></form>
_END;
}
$result->close();
$conn->close();
function get_post($conn, $var)
{
    return $conn->real_escape_string($_POST[$var]);
}

?>