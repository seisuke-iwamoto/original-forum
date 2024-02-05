<?php
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');
session_start();

// $_POSTが空でないかをチェック
if (!empty($_POST)) {
  // ユーザーネームが空かどうかチェック
  if ($_POST['username'] == '') {
    $error['username'] = 'blank';
  }
  // パスワード（半角英数字混在の8文字以上をチェック）
  if (strlen($_POST['password']) < 8 || !preg_match('/[A-Za-z]/', $_POST['password']) || !preg_match('/[0-9]/', $_POST['password'])) {
    $error['password'] = 'length';
  }
  // パスワードが空かどうかチェック
  if ($_POST['password'] == '') {
    $error['password'] = 'blank';
  }

  // 重複アカウントのチェック
  if (empty($error)) {
    $user = $db->prepare('SELECT COUNT(*) AS cnt FROM users WHERE username=?');
    $user->execute(array($_POST['username']));
    $record = $user->fetch();
    if ($record['cnt'] > 0) {
      $error['username'] = 'duplicate';
    }
  }

  // 入力内容にエラーがなければセッションに値を保存して確認画面へ進む
  if (empty($error)) {
    $_SESSION['join'] = $_POST;
    header('Location: check.php');
    exit();
  }
}

// 確認画面から入力画面に戻った際に入力内容を再現
if ($_REQUEST['action'] == 'rewrite') {
  $_POST = $_SESSION['join'];
  $error['rewrite'] = true;
}
?>

<?php
// ヘッダー
$pageTitle = '会員登録画面';
require_once($root_pass . 'template/header.php');
?>

<!-- 会員登録フォーム -->
<div class="container mx-auto my-8">
  <div class="max-w-sm mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">会員登録</h2>
    <form action="" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">ユーザーネーム</label>
        <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ユーザーネーム" value="<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES); ?>">
        <?php if ($error['username'] == 'blank') : ?>
          <p class="text-red-500 font-bold text-sm py-2">ユーザーネームを入力してください</p>
        <?php endif; ?>
        <?php if ($error['username'] == 'duplicate') : ?>
          <p class="text-red-500 font-bold text-sm py-2">指定されたユーザーネームはすでに登録されています</p>
        <?php endif; ?>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">パスワード</label>
        <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="********" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>">
        <label class="block w-fit mt-1">
          <input type="checkbox" id="togglePassword">
          パスワードを表示
        </label>
        <?php if ($error['password'] == 'length') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            半角英数字混在の8文字以上で入力してください
          </p>
        <?php endif; ?>
        <?php if ($error['password'] == 'blank') : ?>
          <p class="text-red-500 font-bold text-sm py-2">
            パスワードを入力してください
          </p>
        <?php endif; ?>
      </div>
      <div class="flex flex-col">
        <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          入力内容を確認する
        </button>
        <a href="<?php $root_pass . 'login/';?>" class="block mt-2 align-baseline font-bold text-sm text-center text-blue-500 hover:text-blue-800 duration-300">
          既に会員の方はこちらから ログイン
        </a>
      </div>
    </form>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>