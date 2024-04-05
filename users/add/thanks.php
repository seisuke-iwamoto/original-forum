<?php
ob_start();
session_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'config/dbconect.php');

// 入力画面でセッション「join」が保存されていたら登録処理を実施
if (isset($_SESSION['join'])) {
  $statement = $db->prepare('INSERT INTO users SET username=?, password=?, create_date=NOW()');
  $ret = $statement->execute(array(
    $_SESSION['join']['username'],
    sha1($_SESSION['join']['password']),
  ));
  unset($_SESSION['join']);
}
?>

<?php
// ヘッダー
$page_title = '会員登録完了画面';
require_once($root_pass . 'template/header.php');
?>

<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-96 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">会員登録完了</h2>
    <p class="mb-4">会員登録が正常に完了しました。ありがとうございます！</p>
    <div class="flex items-center justify-between mt-5">
      <a href="index.php" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">ホームページに戻る</a>
      <a href="<?php echo $root_pass; ?>login/" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 duration-300">ログインページへ</a>
    </div>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>