<?php
// データベースと接続
include_once("../database/connect.php");

//タスクを新規追加
if (isset($_POST["add"])) {
    $task_name = $_POST["task_name"];
    $due_date = $_POST["due_date"];
    $is_done = 0;

    $sql = "INSERT INTO tasks (task_name, due_date, is_done) VALUES(:task_name, :due_date, :is_done)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':task_name', $task_name);
    $stmt->bindParam(':due_date', $due_date);
    $stmt->bindParam(':is_done', $is_done);

    $stmt->execute();

    //index.htmlへ遷移
    header("Location: http://localhost:8080/php_practice_todo/index.php");
    exit();
}
