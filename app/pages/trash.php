<?php
//データベースと接続
include_once("../database/connect.php");

// 完了したタスク一覧を取得
$sql = "SELECT * FROM tasks WHERE is_done = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$task_array = $stmt;

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ゴミ箱</title>
</head>

<body>
    <!-- ヘッダーを読み込み -->
    <?php include("../../parts/header.php") ?>

    <main>
        <div class="container">
            <h2>ゴミ箱</h2>

            <!-- タスク一覧を表示するエリア -->
            <div class="task_list_area">
                <table>
                    <tr>
                        <th>タスク</th>
                        <th>期限</th>
                        <th>完全に削除</th>
                    </tr>
                    <?php foreach ($task_array as $task): ?>
                        <tr>
                            <td><?= $task["task_name"] ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($task["due_date"])) ?></td>
                            <form action="" method="post">
                                <input type="hidden" name="id" value="<?= $task["id"] ?>">
                                <input type="submit" name="completelyDelete" value="完全に削除">
                            </form>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>

            <!-- タスク一覧へ遷移するボタン -->
            <button><a href="../../index.php">タスク一覧へ</a></button>
        </div>
    </main>


</body>

</html>