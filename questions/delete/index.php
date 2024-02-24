<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');
session_start();

if (isset($_SESSION['id'])) {
  $id = $_REQUEST['id'];

  // 投稿を検査する
  $questions = $db->prepare('SELECT * FROM questions WHERE id=?');
  $questions->execute(array($id));
  $question = $questions->fetch();

  if ($question['user_id'] == $_SESSION['id']) {
    // 削除する
    $del = $db->prepare('UPDATE questions SET update_date=NOW(), delete_flag=true WHERE id=?');
    $del->execute(array($id));
  }
}

header('Location: ../');
exit();
?>