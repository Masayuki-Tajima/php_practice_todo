<?php
try {
    // データベースと接続
    include_once("../database/connect.php");

    //データベースの内容を更新する
    if (isset($_POST["edit"])) {
        $sql = "UPDATE tasks SET task_name = :task_name, due_date = :due_date WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":task_name", $_POST["task_name"]);
        $stmt->bindParam(":due_date", $_POST["due_date"]);
        $stmt->bindParam(":id", $_POST["id"]);

        $stmt->execute();

        //index.htmlへ遷移
        header("Location: http://localhost:8080/php_practice_todo/index.php");
        exit();
    }
} catch (PDOException $e) {
    echo "データベースに接続できませんでした。" . $e->getMessage();
}
