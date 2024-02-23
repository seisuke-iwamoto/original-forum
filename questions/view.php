<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../';
require($root_pass . 'dbconect.php');
session_start();

// URLに投稿のidがついているかどうか確認
if (empty($_REQUEST['id'])) {
  header('Location: index.php');
  exit();
}

// ログインのID、質問に紐づくユーザーID、質問のIDが合致する情報を取得
$questions_query = $db->prepare('SELECT u.nickname, q.* FROM users u, questions q WHERE u.id=q.user_id AND q.id=? ORDER BY q.create_date DESC');
$questions_query->execute(array($_REQUEST['id']));
$question = $questions_query->fetch();
?>

<?php
// ヘッダー
$page_title = '投稿詳細画面';
require_once($root_pass . 'template/header.php');
?>

<!-- 投稿詳細画面 -->
<div class="container mx-auto my-8">
  <?php if ($question) : ?>
    <div class="bg-white rounded-lg shadow-lg max-w-4xl mx-auto p-4">
      <time class="text-sm mb-2">
        投稿日時：
        <?php echo htmlspecialchars($question['create_date']); ?>
      </time>
      <h2 class="font-bold text-xl mb-2">
        投稿者：
        <?php echo htmlspecialchars($question['nickname']); ?>
      </h2>
      <p>
        <?php echo mb_strimwidth(htmlspecialchars($question['body']), 0, 300, '...'); ?>
      </p>
      <div class="flex flex-col mt-12">
        <a href="<?php echo $root_pass; ?>" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold text-center block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          回答する
        </a>
        <a href="<?php echo $root_pass; ?>questions" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">質問一覧に戻る</a>
      </div>
    </div>
  <?php else : ?>
    <p class="py-5">
      投稿は削除されたか、見つかりません
    </p>
  <?php endif; ?>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>