<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');
session_start();

// ログインしているか確認
if (isset($_SESSION['id'])) {
  $userid = $_SESSION['id'];

  // $_POSTが空でないかをチェック
  if (!empty($_POST)) {
    // 現在のパスワードがDBに登録されている値と合致するか
    $user = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE password=?');
    $user->execute(array(sha1($_POST['current_password'])));
    $record = $user->fetch();
    if ($record['cnt'] == 0) {
      $error['current_password'] = 'mismatch';
    }
    // 現在のパスワードが空かどうかチェック
    if ($_POST['current_password'] == '') {
      $error['current_password'] = 'blank';
    }
    // 新しいパスワードをチェック（半角英数字混在の8文字以上をチェック）
    if (strlen($_POST['new_password']) < 8 || !preg_match('/[A-Za-z]/', $_POST['new_password']) || !preg_match('/[0-9]/', $_POST['new_password'])) {
      $error['new_password'] = 'length';
    }
    // 現在のパスワードと新しいパスワードが重複していないかチェック
    if ($_POST['new_password'] == $_POST['current_password']) {
      $error['new_password'] = 'duplicate';
    }
    // 新しいパスワードが空かどうかチェック
    if ($_POST['new_password'] == '') {
      $error['new_password'] = 'blank';
    }

    // エラーがなければDBのパスワードを更新
    if (empty($error)) {
      $statement = $db->prepare('UPDATE users SET password = :password WHERE id = :id');
      $statement->bindParam(':password', sha1($_POST['new_password']), PDO::PARAM_STR);
      $statement->bindParam(':id', $userid, PDO::PARAM_STR);
      $ret = $statement->execute();
      $status = 'complete';
    }
  }
} else {
  // ログインしてなければログイン画面へ
  header('Location: ../../login/');
  exit();
}
?>

<?php
// ヘッダー
$page_title = 'パスワード更新画面';
require_once($root_pass . 'template/header.php');
?>

<!-- パスワード更新画面 -->
<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-96 min-h-80 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">パスワード更新画面</h2>
    <form action="" method="POST" class="mt-12">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">現在のパスワード</label>
        <input type="text" id="current_password" name="current_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <?php if ($error['current_password'] == 'blank') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            現在のパスワードを入力してください
          </p>
        <?php endif; ?>
        <?php if ($error['current_password'] == 'mismatch') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            現在のパスワードが違います
          </p>
        <?php endif; ?>
      </div>
      <div class="mb-10">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">新しいパスワード</label>
        <input type="text" id="new_password" name="new_password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <?php if ($error['new_password'] == 'blank') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            新しいパスワードを入力してください
          </p>
        <?php endif; ?>
        <?php if ($error['new_password'] == 'duplicate') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            現在のパスワードと違うパスワードを指定してください
          </p>
        <?php endif; ?>
        <?php if ($error['new_password'] == 'length') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            半角英数字混在の8文字以上で入力してください
          </p>
        <?php endif; ?>
        <?php if ($status == 'complete') : ?>
          <p class="text-green-400 font-bold text-sm pt-4">
            パスワードを更新しました
          </p>
        <?php endif; ?>
      </div>
      <div class="flex flex-col">
        <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          更新する
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