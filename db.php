<?php

try {
    $db = new PDO("mysql:host=127.0.0.1;dbname=test_call_log", "test_call_log", "qweRTY123",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
}
catch(PDOException $e)
{
    echo $e->getMessage();
    die("Ошибка подключения.");
}