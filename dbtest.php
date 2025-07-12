<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO(
        'mysql:host=mysql80.mikatea.sakura.ne.jp;dbname=mikatea_designthinking;charset=utf8mb4',
        ' ',
        ' '
    );
    echo 'DB CONNECT OK';
} catch (PDOException $e) {
    echo 'DB CONNECT ERROR: ' . $e->getMessage();
}
?>
