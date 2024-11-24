<?php
//データベースと接続
include_once("../database/connect.php");

//編集するタスクをデータベースから取得する
$task_array = array();

$sql = "SELECT * FROM tasks WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $_POST["id"]);

$stmt->execute();
$task_array = $stmt;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク編集</title>
</head>

<body>
    <!-- ヘッダーを読み込み -->
    <?php include("../../parts/header.php") ?>

    <main>
        <div class="container">
            <form action="../functions/update.php" method="post">
                <?php foreach ($task_array as $task): ?>
                    <label for="task_name">タスク</label>
                    <input type="text" name="task_name" value="<?= $task["task_name"] ?>">

                    <label for="due_date">期限</label>
                    <input type="datetime-local" name="due_date" value="<?= date("Y-m-d H:i", strtotime($task["due_date"])) ?>">

                    <input type="hidden" name="id" value="<?= $task["id"] ?>">
                <?php endforeach ?>
                <input type="submit" name="edit" value="編集">
            </form>
        </div>
    </main>
</body>

</html>