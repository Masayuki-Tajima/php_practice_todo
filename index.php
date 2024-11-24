<?php
//データベースと接続
include_once("./app/database/connect.php");

include("./app/functions/task_get.php");

//セッションスタート
session_start();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>TODOリスト</title>
</head>

<body>
    <!-- ヘッダーを読み込み -->
    <?php include("./parts/header.php") ?>

    <!-- エラーメッセージがあれば表示 -->
    <?php include("./parts/validation.php") ?>

    <?php unset($_SESSION["error_message"]) ?>

    <main>
        <div class="container">
            <!-- タスクを追加する欄 -->
            <div class="task_add_area">
                <form action="./app/functions/create.php" method="post">
                    <input type="text" name="task_name">
                    <input type="datetime-local" name="due_date">
                    <input type="submit" name="add" value="追加" class="button">
                </form>
            </div>

            <!-- タスク一覧を表示するエリア -->
            <div class="task_list_area">
                <h2>タスク一覧</h2>
                <table>
                    <tr>
                        <th>タスク</th>
                        <th>期限</th>
                        <th>編集</th>
                        <th>完了</th>
                    </tr>
                    <?php foreach ($task_array as $task): ?>
                        <tr>
                            <td><?= $task["task_name"] ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($task["due_date"])) ?></td>
                            <td>
                                <form action="./app/pages/edit.php" method="post">
                                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                    <input type="submit" value="編集">
                                </form>
                            </td>
                            <td>
                                <form action="./app/functions/delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $task['id'] ?>">
                                    <input type="submit" name="delete" value="完了!">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>

            <!-- ゴミ箱へ遷移するボタン -->
            <button><a href="./app/pages/trash.php">ゴミ箱へ</a></button>
        </div>
    </main>
</body>

</html>