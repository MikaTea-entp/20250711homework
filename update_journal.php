<?php
// DB接続
$pdo = new PDO('mysql:host=mysql3109.db.sakura.ne.jp;dbname=mikatea_designthinking;charset=utf8mb4', ' ', ' ');

// POSTデータ受け取り
$id = $_POST['id'] ?? '';
$content = $_POST['content'] ?? '';

// 入力バリデーション
if (!$id || !$content) {
    http_response_code(400);
    echo "Invalid input.";
    exit;
}

// 更新クエリ
$stmt = $pdo->prepare("UPDATE journals SET content = ? WHERE id = ?");
$stmt->execute([$content, $id]);

echo "OK";
?>
