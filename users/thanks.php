<?php
// ヘッダー
$pageTitle = '会員登録完了画面';
require_once('../template/header.php');
?>

<div class="container mx-auto my-8">
    <div class="max-w-sm mx-auto bg-white rounded-lg shadow-lg p-6">
      <h2 class="font-bold text-xl mb-4">会員登録完了</h2>
      <p class="mb-4">会員登録が正常に完了しました。ありがとうございます！</p>
      <div class="flex items-center justify-between">
        <a href="index.php" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">ホームページに戻る</a>
        <a href="login.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 duration-300">ログインページへ</a>
      </div>
    </div>
</div>

<?php
// フッター
require_once('../template/footer.php');
?>