<?php
try {
    //データベースに接続する
    $db = "mysql:host=localhost;dbname=php_practice_todo";
    $username = "root";
    $password = "sjsm1326";

    $pdo = new PDO($db, $username, $password);
} catch (PDOException $e) {
    echo "データベースに接続できませんでした。" . $e->getMessage();
}
