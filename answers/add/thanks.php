<?php
ob_start();
session_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'config/dbconect.php');

// 回答作成画面でセッション「answers」が保存されていたら登録処理を実施
if (isset($_SESSION['answers_body'])) {
  $answers = $db->prepare('INSERT INTO answers SET user_id=?, question_id=?, body=?, create_date=NOW()');
  $ret = $answers->execute(array(
    $_SESSION['id'],
    $_SESSION['question_id'],
    $_SESSION['answers_body'],
  ));
  unset($_SESSION['answers_body']);
}
?>

<?php
// ヘッダー
$page_title = '回答完了画面';
require_once($root_pass . 'template/header.php');
?>

<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-3/5 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">回答完了</h2>
    <p class="py-14 text-center">質問文への回答が完了しました。</p>
    <div class="flex flex-col">
      <a href="<?php echo $root_pass; ?>questions/" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">質問一覧に戻る</a>
    </div>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>