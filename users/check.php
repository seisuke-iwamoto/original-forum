<?php
session_start();
// require('../dbconnect.php');

// 入力画面でセッション「join」が保存されたかをチェック
if (!isset($_SESSION['join'])) {
  header('Location: index.php');
  exit();
}
?>

<?php
// ヘッダー
$pageTitle = '入力内容確認画面';
require_once('../template/header.php');
?>

<form action="" method="POST" class="mx-auto my-8">
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
      <ul class="flex gap-5">
        <li>
          <a href="index.php?action=rewrite" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">戻る</a>
        </li>
        <li>
          <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">登録完了</button>
        </li>
      </ul>
    </div>
  </div>
</form>

<?php
// フッター
require_once('../template/footer.php');
?>