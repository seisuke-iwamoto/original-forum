<?php
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');
session_start();

// $_POSTが空でないかをチェック
if (!empty($_POST)) {
  // ユーザーネームが空かどうかチェック
  if ($_POST['questions_body'] == '') {
    $error['questions_body'] = 'blank';
  }
  if (mb_strlen($_POST['questions_body']) > 1000) {
    $error['questions_body'] = 'length';
  }

  // 入力内容にエラーがなければセッションに値を保存して確認画面へ進む
  if (empty($error)) {
    $_SESSION['questions'] = $_POST;
    header('Location: check.php');
    exit();
  }
}

// 確認画面から入力画面に戻った際に入力内容を再現
if ($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['questions'];
  $error['rewrite'] = true;
}
?>

<?php
// ヘッダー
$page_title = '質問投稿画面';
require_once($root_pass . 'template/header.php');
?>

<!-- 質問投稿画面 -->
<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-3/5 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-6">質問投稿画面</h2>
    <form action="" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-1">質問文</label>
        <textarea id="questions_body" name="questions_body" class="shadow appearance-none border rounded w-full h-96 py-2 px-3 text-gray-700 leading-normal focus:outline-none focus:shadow-outline" placeholder="1000文字以内で質問内容を入力してください"><?php echo htmlspecialchars($_POST['questions_body'], ENT_QUOTES); ?></textarea>
        <div class="flex items-center justify-end text-gray-400 text-sm mt-2">
          あと
          <span id="count" class="text-black text-base font-bold mx-1">1000</span>
          文字まで入力できます
        </div>
        <?php if ($error['questions_body'] == 'blank') : ?>
          <p class="text-red-500 font-bold text-sm text-right py-2">質問文を入力してください</p>
        <?php endif; ?>
        <?php if ($error['questions_body'] == 'length') : ?>
          <p class="text-red-500 font-bold text-sm text-right py-2">質問文は1000文字以内で入力してください</p>
        <?php endif; ?>
      </div>
      <div class="flex flex-col">
        <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          質問内容を確認する
        </button>
        <a href="<?php echo $root_pass; ?>questions" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">質問一覧に戻る</a>
      </div>
    </form>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>