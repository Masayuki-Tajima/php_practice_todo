<?php
try {
    include_once("./app/database/connect.php");

    // フォームから送信された内容を取得
    $task_array = array();

    $sql = "SELECT * FROM tasks";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $task_array = $stmt;

    // var_dump($task_array->fetchAll());
} catch (PDOException $e) {
    echo "データベースに接続できませんでした。" . $e->getMessage();
}

// if (isset($_POST["add"])) {
//     $task_name = $_POST["task_name"];
//     echo $task_name;
// }
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
    <header>
        <div class="header_left">
            <h1>TODOリスト</h1>
        </div>
    </header>

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
                        <th>is_done</th>
                        <th>タスク</th>
                        <th>日付</th>
                        <th>ゴミ箱へ</th>
                    </tr>
                    <?php foreach ($task_array as $task): ?>
                        <tr>
                            <td><?= $task["is_done"] ?></td>
                            <td><?= $task["task_name"] ?></td>
                            <td><?= $task["due_date"] ?></td>
                            <td>ボタン</td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </main>
</body>

</html>