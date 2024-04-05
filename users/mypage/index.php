<?php
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'config/dbconect.php');
session_start();

// ログインしているか確認
if (isset($_SESSION['id'])) {
  // ログインしているユーザーのidと合致するユーザー情報をDBから検索
  $userid = $_SESSION['id'];
  $users = $db->prepare("SELECT username,nickname FROM users WHERE id = :id");
  $users->bindParam(':id', $userid, PDO::PARAM_STR);
  $users->execute();
  $users_details = $users->fetch();
} else {
  // ログインしてなければログイン画面へ
  header('Location: ../../login/');
  exit();
}
?>

<?php
// ヘッダー
$page_title = 'マイページ';
require_once($root_pass . 'template/header.php');
?>

<!-- マイページ -->
<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-96 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-6">マイページ</h2>
    <form action="" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-1">ユーザーネーム</label>
        <div class="w-full py-1 px-3 text-gray-700 mb-3">
          <?php echo htmlspecialchars($users_details['username'], ENT_QUOTES); ?>
        </div>
      </div>
      <div class="mb-6">
        <label for="password" class="block text-gray-700 text-sm font-bold mb-1">ニックネーム</label>
        <div class="w-full py-1 px-3 text-gray-700 mb-3">
          <?php echo htmlspecialchars($users_details['nickname'], ENT_QUOTES); ?>
        </div>
      </div>
      <div>
        <a href="<?php echo $root_pass; ?>questions" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">質問一覧に戻る</a>
      </div>
    </form>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>