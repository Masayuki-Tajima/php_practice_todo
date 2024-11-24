<?php
try {
    $task_array = array();

    // 未完了のタスク一覧を取得
    $sql = "SELECT * FROM tasks WHERE is_done = 0";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $task_array = $stmt;
} catch (PDOException $e) {
    echo "データベースに接続できませんでした。" . $e->getMessage();
}
