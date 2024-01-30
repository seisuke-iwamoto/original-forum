<?php
try {
  $db = new PDO('mysql:dbname=original_forum_db;host=mysql;charset=utf8', 'root', 'root');
} catch (PDOException $e) {
  echo 'DB接続エラー： ' . $e->getMessage();
}
?>