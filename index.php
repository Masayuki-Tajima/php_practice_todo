<?php
try {
    include_once("./app/database/connect.php");

    $task_array = array();

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
    }

    // タスク一覧を取得
    $sql = "SELECT * FROM tasks";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $task_array = $stmt;
} catch (PDOException $e) {
    echo "データベースに接続できませんでした。" . $e->getMessage();
}

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

    <main>
        <div class="container">
            <!-- タスクを追加する欄 -->
            <div class="task_add_area">
                <h2>New Task</h2>
                <form action="" method="post">
                    <input type="text" name="task_name">
                    <input type="datetime-local" name="due_date">
                    <input type="submit" name="add" value="追加" class="button">
                </form>
            </div>

            <!-- タスク一覧を表示するエリア -->
            <div class="task_list_area">
                <table>
                    <tr>
                        <th>タスク</th>
                        <th>日付</th>
                        <th>ゴミ箱へ</th>
                    </tr>
                    <?php foreach ($task_array as $task): ?>
                        <tr>
                            <td><?= $task["task_name"] ?></td>
                            <td><?= date("Y-m-d H:i", strtotime($task["due_date"])) ?></td>
                            <td>ボタン</td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </main>
</body>

</html>