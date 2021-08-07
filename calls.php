<!doctype html>
<html>
<head>
    <title>Чтение из базы</title>
    <meta charset="utf-8">
    <style>
        .error {color: red; font-size: 1.2em;}
    </style>
</head>
<body>

<?php

include "db.php";

if (!empty($_POST['surname']) || !empty($_POST['id_calls']))
{
    var_dump($_POST);
    if ($_POST['action'] == 0)
    {
        $stmt = $db->prepare('INSERT INTO calls (id_user, call_time, call_duration, cost) VALUES
(:id_user, :call_time, :call_duration, :cost)');
        $stmt->bindParam(':id_user', $_POST['id_user']);
        $stmt->bindParam(':call_time', $_POST['call_time']);
        $stmt->bindParam(':call_duration', $_POST['call_duration']);
        $stmt->bindParam(':cost', $_POST['cost']);
    }
    elseif ($_POST['action'] == 1) {
        $stmt = $db->prepare('UPDATE `calls` SET `id_user`=:id_user,`call_time`=:call_time,`call_duration`=:call_duration,`cost`=:cost WHERE id_calls = :id_calls');
        $stmt->bindParam(':id_calls', $_POST['id_calls']);
        $stmt->bindParam(':id_user', $_POST['id_user']);
        $stmt->bindParam(':call_time', $_POST['call_time']);
        $stmt->bindParam(':call_duration', $_POST['call_duration']);
        $stmt->bindParam(':cost', $_POST['cost']);
    }
    elseif ($_POST['action'] == 2)
    {
        $stmt = $db->prepare('DELETE FROM `calls` WHERE id_calls = :id_calls');
        $stmt->bindParam(':id_calls', $_POST['id_calls']);
    }
    if ($stmt->execute()) {echo "Успешно";}
    else {
        echo "Ошибка: "; print_r($stmt->errorInfo());
    }
}
else { echo "<p class=\"error\">Должны быть заполнены все поля.</p>"; }

?>

<p><a href="../index.php">Вернуться на главную</a></p>
</body>
</html>