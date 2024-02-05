<?php
ob_start();
session_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');

// 入力画面でセッション「join」が保存されたかをチェック
if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}

// 登録処理をする
if (!empty($_POST)) {
  $statement = $db->prepare('INSERT INTO users SET username=?, password=?, create_date=NOW()');
  echo $ret = $statement->execute(array(
    $_SESSION['join']['username'],
    sha1($_SESSION['join']['password']),
  ));
  unset($_SESSION['join']);
  
  header('Location: thanks.php');
  exit();
}
?>

<?php
// ヘッダー
$pageTitle = '入力内容確認画面';
require_once($root_pass . 'template/header.php');
?>

<form action="thanks.php" method="POST" class="mx-auto my-8">
  <!-- <input type="hidden" name="action" value="submit"> -->
  <div class="max-w-sm mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">会員登録内容確認</h2>
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2">ユーザーネーム</label>
      <div class="w-full py-2 px-3 text-gray-700 mb-3">
        <?php echo htmlspecialchars($_SESSION['join']['username'], ENT_QUOTES); ?>
      </div>
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2">パスワード</label>
      <div class="w-full py-2 px-3 text-gray-700 mb-3">
        <?php echo str_repeat('*', strlen($_SESSION['join']['password'])); ?>
      </div>
    </div>
    <div class="">
      <ul class="flex items-center justify-center gap-5">
        <li>
          <a href="index.php?action=rewrite" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold block py-2 px-4 rounded focus:outline-none focus:shadow-outline">戻る</a>
        </li>
        <li>
          <button type="button" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">登録する</button>
        </li>
      </ul>
    </div>
  </div>
</form>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>