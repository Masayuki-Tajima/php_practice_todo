<?php
try {
    //データベースに接続する
    $db = "mysql:host=localhost;dbname=php_practice_todo";
    $username = "root";
    $password = "sjsm1326";

    $pdo = new PDO($db, $username, $password);

    // フォームから送信された内容を取得
    $stmt = $pdo->prepare("SELECT * FROM tasks");
    $stmt->execute();
    
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
                    <tr>
                        <td>done</td>
                        <td>朝食</td>
                        <td>2024-09-01 12:00</td>
                        <td>ボタン</td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
</body>

</html>