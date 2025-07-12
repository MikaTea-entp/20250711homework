<?php
// こうなればヤケクソ。funcs.phpを使わずに直接書いたバージョンに戻す（#^ω^）
// XSSサニタイズ
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

// DB接続
try {
    $pdo = new PDO('mysql:host=mysql3109.db.sakura.ne.jp;dbname=mikatea_designthinking;charset=utf8mb4',
        ' ',
        ' '
    );
} catch (PDOException $e) {
    http_response_code(500);
    echo 'DB接続失敗: ' . $e->getMessage(); // これでエラー文が見える！
    exit;
}

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if ($title && $content) {
    $stmt = $pdo->prepare("INSERT INTO journals (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->execute([$title, $content]);
    echo 'success';
} else {
    http_response_code(400);
    echo 'error';
}
?>