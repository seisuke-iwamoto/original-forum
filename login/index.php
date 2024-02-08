<?php
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../';
require($root_pass . 'dbconect.php');
session_start();

if (!empty($_POST)) {
  // ログイン処理
  if ($_POST['username'] != '' && $_POST['password'] != '') {
    $login = $db->prepare('SELECT * FROM users WHERE username=? AND password=?');
    $login->execute(array(
      $_POST['username'],
      sha1($_POST['password'])
    ));
    $user = $login->fetch();

    if ($user) {
      // ログイン成功
      $_SESSION['id'] = $user['id'];
      $_SESSION['time'] = time();

      // ログイン情報を記録する
      if ($_POST['save'] == 'on') {
        setcookie('username', $_POST['username'], time() + 60 * 60 * 24 * 14);
        setcookie('password', $_POST['password'], time() + 60 * 60 * 24 * 14);
      }

      header('Location: ../questions/');
      exit();
    } else {
      $error['login'] = 'failed';
    }
  } else {
    $error['login'] = 'blank';
  }
}
?>

<?php
// ヘッダー
$pageTitle = '会員登録画面';
require_once($root_pass . 'template/header.php');
?>

<!-- ログイン画面 -->
<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-96 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">ログイン</h2>
    <form action="" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">ユーザーネーム</label>
        <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ユーザーネーム" value="<?php echo htmlspecialchars($_POST['username'], ENT_QUOTES); ?>">
        <?php if ($error['login'] == 'blank') : ?>
          <p class="text-red-500 font-bold text-sm py-2">ユーザーネームとパスワードをご記入ください</p>
        <?php endif; ?>
        <?php if ($error['login'] == 'failed') : ?>
          <p class="text-red-500 font-bold text-sm py-2">ログインに失敗しました。正しくご記入ください</p>
        <?php endif; ?>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">パスワード</label>
        <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="********" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>">
        <label class="block w-fit mt-1">
          <input type="checkbox" id="togglePassword">
          パスワードを表示
        </label>
      </div>
      <div class="flex flex-col">
        <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold inline-block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          ログイン
        </button>
        <a href="<?php echo $root_pass; ?>users/add" class="block mt-2 align-baseline font-bold text-sm text-center text-blue-500 hover:text-blue-800 duration-300">
          会員登録がまだの方はこちら
        </a>
      </div>
    </form>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>