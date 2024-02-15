<?php
ob_start();
session_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');

// 投稿画面でセッション「questions」が保存されたかをチェック
if (!isset($_SESSION['questions'])) {
  header('Location: index.php');
  exit();
}
?>

<?php
// ヘッダー
$page_title = '投稿内容確認画面';
require_once($root_pass . 'template/header.php');
?>

<div class="flex items-center justify-center container mx-auto my-8">
  <form action="thanks.php" method="POST" class="w-full mx-auto my-8">
    <div class="w-3/5 mx-auto bg-white rounded-lg shadow-lg p-6">
      <h2 class="font-bold text-xl mb-4">投稿内容確認</h2>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">質問文</label>
        <div class="w-full min-h-48 py-2 px-3 text-gray-700 mb-3">
          <?php echo htmlspecialchars($_SESSION['questions']['questions_body'], ENT_QUOTES); ?>
        </div>
      </div>
      <div>
        <div class="flex flex-col">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold text-center block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">投稿する</button>
          <a href="index.php?action=rewrite" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">戻る</a>
        </div>
      </div>
    </div>
  </form>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>