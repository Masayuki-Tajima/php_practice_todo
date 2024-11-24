<?php
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
    <?php include("../parts/header.php") ?>


</body>

</html>