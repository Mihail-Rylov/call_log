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

if (!empty($_POST['operator_name']) || !empty($_POST['id_operator']))
{

    if ($_POST['action'] == 1)
    {
        $stmt = $db->prepare('UPDATE operators SET operator_name=:operator_name, price=:price WHERE id_operator = :id_operator');
        $stmt->bindParam(':id_operator', $_POST['id_operator']);
        $stmt->bindParam(':operator_name', $_POST['operator_name']);
        $stmt->bindParam(':price', $_POST['price']);
    }elseif ($_POST['action'] == 0){
        $stmt = $db->prepare('INSERT INTO operators (operator_name, price) VALUES
(:operator_name, :price)');
        $stmt->bindParam(':operator_name', $_POST['operator_name']);
        $stmt->bindParam(':price', $_POST['price']);
    }elseif ($_POST['action'] == 2) {
        $stmt = $db->prepare('DELETE FROM operators WHERE id_operator = :id_operator');
        $stmt->bindParam(':id_operator', $_POST['id_operator']);
    }
    if ($stmt->execute()) {echo "Успеx";}
    else {
        echo "Ошибка: "; print_r($stmt->errorInfo());
    }
}
else { echo "<p class=\"error\">Должны быть заполнены все поля.</p>"; }

?>

<p><a href="../index.php">Вернуться на главную</a></p>
</body>
</html>