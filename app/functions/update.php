<?php
// データベースと接続
include_once("../database/connect.php");

//セッションスタート
session_start();

//データベースの内容を更新する
if (isset($_POST["edit"])) {
    $task_name = $_POST["task_name"];
    $due_date = $_POST["due_date"];
    $id = $_POST["id"];

    //XSS対策
    $task_name = htmlspecialchars($task_name, ENT_QUOTES, "UTF-8");

    //バリデーションチェック
    if (empty($task_name)) {
        $_SESSION["error_message"]["task_name"] = "タスク名を入力してください。";
    }

    if (empty($due_date)) {
        $_SESSION["error_message"]["due_date"] = "タスクの期限を入力してください。";
    }

    if (empty($_SESSION["error_message"])) {
        //トランザクション開始
        $pdo->beginTransaction();

        try {
            $sql = "UPDATE tasks SET task_name = :task_name, due_date = :due_date WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":task_name", $_POST["task_name"]);
            $stmt->bindParam(":due_date", $_POST["due_date"]);
            $stmt->bindParam(":id", $_POST["id"]);

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
