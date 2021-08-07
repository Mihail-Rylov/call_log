<!doctype html>
<html>
<head>
    <title>Журнал звонков</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include "PHP/db.php";
$operators = $db->query("SELECT * FROM operators")->fetchAll();
$users = $db->query("SELECT * FROM users")->fetchAll();
$calls = $db->query("SELECT * FROM calls")->fetchAll();

?>
<div class = "forms">
    <div class="main_form">
        <form action="PHP/operators.php" method="post" name="operators">
            <label>Действие<br/>
                <select name="action" id="action_operator">
                    <option value="0">Добавить</option>
                    <option value="1">Изменить</option>
                    <option value="2">Удалить</option>
                </select>
            </label>
            <label>Оператор<br/>
                <select name="id_operator" id="operator_id">
                    <?php
                    foreach ($operators as $operator) {
                        echo "<option value=\"$operator[id_operator]\">$operator[operator_name]</option>";
                    }
                    ?>
                </select>
            </label>
            <div class="operator_fields">
                <label>Название<br/><input type="text" name="operator_name"></label>
                <label>Цена<br/><input type="text" name="price"></label>
            </div>
            <input type="submit" value="Отправить">
        </form>
    </div>

    <div class="main_form">
        <form action="PHP/users.php" method="post" name="users">
            <label>Действие<br/>
                <select name="action" id="action_user">
                    <option value="0">Добавить</option>
                    <option value="1">Изменить</option>
                    <option value="2">Удалить</option>
                </select>
            </label>
            <label>Пользователи<br/>
                <select name="id_user" id="id_user">
                    <?php
                    foreach ($users as $user) {
                        echo "<option value=\"$user[id_user]\">$user[surname]</option>";
                    }
                    ?>
                </select>
            </label>
            <div class="user_fields">
                <label>Оператор<br/>
                    <select name="id_operator">
                        <?php
                        foreach ($operators as $operator) {
                            echo "<option value=\"$operator[id_operator]\">$operator[operator_name]</option>";
                        }
                        ?>
                    </select>
                </label>
                <label>Имя<br/><input type="text" name="name"></label>
                <label>Фамилия<br/><input type="text" name="surname"></label>
                <label>Отчество<br/><input type="text" name="patronymic"></label>
                <label>Телефон<br/><input type="text" name="telephone"></label>
            </div>
            <input type="submit" value="Отправить">
        </form>
    </div>

    <div class="main_form">
        <form action="PHP/calls.php" method="post" name="users">
            <label>Действие<br/>
                <select name="action" id="action_calls">
                    <option value="0">Добавить</option>
                    <option value="1">Изменить</option>
                    <option value="2">Удалить</option>
                </select>
            </label>
            <label>Звонки<br/>
                <select name="id_calls" id="id_calls">
                    <?php
                    foreach ($calls as $call) {
                        echo "<option value=\"$call[id_calls]\">$call[call_time]</option>";
                    }
                    ?>
                </select>
            </label>
            <div class="calls_fields">
                <label>Пользователь<br/>
                    <select name="id_user">
                        <?php
                        foreach ($users as $user) {
                            echo "<option value=\"$user[id_user]\">$user[surname]</option>";
                        }
                        ?>
                    </select>
                </label>
                    <label>Время совершения звонка<br/><input type="datetime-local" name="call_time"></label>
                    <label>Продолжительность звонка<br/><input type="text" name="call_duration"></label>
                    <label>Цена<br/><input type="text" name="cost"></label>
            </div>
            <input type="submit" value="Отправить">
        </form>
    </div>
    <p><a href="PHP/duration.php">Общая длительность разговоров по каждому пользователю</a></p>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] != 'POST' ) {
    $sql = "SELECT users.surname, users.telephone, operators.operator_name , DATE_FORMAT(calls.call_time,'%d-%m-%Y, %H:%i:%S') AS call_time, calls.call_duration, calls.cost FROM users, operators, calls WHERE users.id_user = calls.id_user AND operators.id_operator = users.id_operator";

}
$result = $db->query($sql);
if ($result && $result->rowCount() > 0) {
    ?>
    <table class = "tab">
        <thead>
        <tr><th>Пользователь</th><th>Телефон</th><th>Оператор</th><th>время совершения звонка</th><th>Продолжительность звонка</th>><th>Цена</th></tr>
        </thead>
        <?php
        while ($row = $result->fetch()) {
            echo "<tr><td>$row[surname]</td><td>$row[telephone]</td><td>$row[operator_name]</td><td>$row[call_time]</td><td>$row[call_duration]</td><td>$row[cost]</td></tr>";
        }
        ?>
    </table>
    <?php
} else {
    echo "<p>Данных в таблице нет.</p>";
}
?>
<script src="script.js"></script>
</body>
</html>