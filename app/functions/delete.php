<?php
// データベースと接続
include_once("../database/connect.php");

//データベースのis_doneを更新する
if (isset($_POST["delete"])) {
    //トランザクション開始
    $pdo->beginTransaction();

    try {
        $sql = "UPDATE tasks SET is_done = 1 WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(":id", $_POST["id"]);

        $stmt->execute();

        $pdo->commit();
    } catch (Exception $error) {
        $pdo->rollBack();
    }

    //index.htmlへ遷移
    header("Location: http://localhost:8080/php_practice_todo/index.php");
    exit();
}
