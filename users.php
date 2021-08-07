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

if (!empty($_POST['surname']) || !empty($_POST['id_user']))
{
    var_dump($_POST);
    if ($_POST['action'] == 0)
    {
        $stmt = $db->prepare('INSERT INTO users (id_operator, name, surname, patronymic, telephone) VALUES
(:id_operator, :name, :surname, :patronymic, :telephone)');
        $stmt->bindParam(':id_operator', $_POST['id_operator']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':surname', $_POST['surname']);
        $stmt->bindParam(':patronymic', $_POST['patronymic']);
        $stmt->bindParam(':telephone', $_POST['telephone']);
    }
    elseif ($_POST['action'] == 1) {
        $stmt = $db->prepare('UPDATE users SET `id_operator`=:id_operator,`name`=:name,`surname`=:surname,`patronymic`=:patronymic,`telephone`=:telephone WHERE `id_user`=:id_user');
        $stmt->bindParam(':id_user', $_POST['id_user']);
        $stmt->bindParam(':id_operator', $_POST['id_operator']);
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':surname', $_POST['surname']);
        $stmt->bindParam(':patronymic', $_POST['patronymic']);
        $stmt->bindParam(':telephone', $_POST['telephone']);
    }
    elseif ($_POST['action'] == 2)
    {
        $stmt = $db->prepare('DELETE FROM users WHERE id_user = :id_user');
        $stmt->bindParam(':id_user', $_POST['id_user']);
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