<!doctype html>
<html>
<head>
    <title>Общая длительность разговоров по каждому пользователю</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<?php

include "db.php";

$sql = "SELECT users.surname AS surname, SUM(calls.call_duration) AS duration FROM calls, users WHERE calls.id_user = users.id_user GROUP BY calls.id_user";
$result = $db->query($sql);
if ($result && $result->rowCount() > 0) {
    ?>
    <table>
        <thead>
        <tr><th>Пользователь</th><th>Продолжительность звонка</th>></tr>
        </thead>
        <?php
        while ($row = $result->fetch()) {
            echo "<tr><td>$row[surname]</td><td>$row[duration]</td>></tr>";
        }
        ?>
    </table>
    <?php
} else {
    echo "<p>Данных в таблице нет.</p>";
}
?>

<p><a href="../index.php">Вернуться на главную</a></p>
</body>
</html>