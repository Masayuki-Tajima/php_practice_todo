<?php
// データベースと接続
include_once("../database/connect.php");

//セッションスタート
session_start();

//タスクを新規追加
if (isset($_POST["add"])) {
    $task_name = $_POST["task_name"];
    $due_date = $_POST["due_date"];
    $is_done = 0;


    $error_message = array();

    //バリデーションチェック
    if (empty($task_name)) {
        $_SESSION["error_message"]["task_name"] = "タスク名を入力してください。";
    } else {
        // XSS対策
        $task_name = htmlspecialchars($task_name, ENT_QUOTES, "UTF-8");
    }

    if (empty($due_date)) {
        $_SESSION["error_message"]["due_date"] = "タスクの期限を入力してください。";
    }

    if (empty($_SESSION["error_message"])) {
        //トランザクション開始
        $pdo->beginTransaction();

        try {
            $sql = "INSERT INTO tasks (task_name, due_date, is_done) VALUES(:task_name, :due_date, :is_done)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':task_name', $task_name);
            $stmt->bindParam(':due_date', $due_date);
            $stmt->bindParam(':is_done', $is_done);

            $stmt->execute();

            $pdo->commit();
        } catch (Exception $error) {
            $pdo->rollBack();
        }
    }

    //index.htmlへ遷移
    header("Location: http://localhost:8080/php_practice_todo/index.php");
    exit();
}
