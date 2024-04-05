<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'config/dbconect.php');
session_start();

if (isset($_SESSION['id'])) {
  $id = $_REQUEST['id'];

  // 回答を検査する
  $answers = $db->prepare('SELECT * FROM answers WHERE id=?');
  $answers->execute(array($id));
  $answer = $answers->fetch();

  if ($answer['user_id'] == $_SESSION['id']) {
    // 削除する
    $del = $db->prepare('UPDATE answers SET update_date=NOW(), delete_flag=true WHERE id=?');
    $del->execute(array($id));
  }
}

header('Location: ../../questions/view.php?id=' . $_SESSION['question_id']);
exit();
?>