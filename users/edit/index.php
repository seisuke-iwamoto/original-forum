<?php
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');
session_start();

// セッションからusernameを取得
$userid = $_SESSION['id'];
// SQLクエリの準備
$stmt = $db->prepare("SELECT nickname FROM users WHERE id = :id");
// バインド変数に値をセット
$stmt->bindParam(':id', $userid, PDO::PARAM_STR);
// クエリ実行
$stmt->execute();

// 結果を取得
if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  // nicknameを取得
  $nickname = $row['nickname'];
} else {
  echo "該当するユーザーが見つかりません。";
}

// ニックネームの変更をDBへ登録
if($_POST['nickname']) {
  $statement = $db->prepare('UPDATE users SET nickname=? WHERE id = :id');
  $statement->bindParam(':id', $userid, PDO::PARAM_STR);
  $ret = $statement->execute(array(
    $_POST['nickname']
  ));
}
?>

<?php
// ヘッダー
$pageTitle = 'ニックネーム変更画面';
require_once($root_pass . 'template/header.php');
?>

<!-- ニックネーム変更画面 -->
<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-96 min-h-80 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-4">ニックネーム変更画面</h2>
    <form action="" method="POST" class="mt-12">
      <div class="mb-8">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-2">ニックネーム</label>
        <input type="text" id="nickname" name="nickname" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo $nickname; ?>">
      </div>
      <div class="flex flex-col">
        <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          変更する
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