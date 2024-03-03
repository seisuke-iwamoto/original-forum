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

// ログインのID、質問に紐づくユーザーID、質問のIDに合致する回答の情報を取得
$answers_query = $db->prepare(
  'SELECT u.nickname, a.* 
FROM users u, answers a 
WHERE u.id=a.user_id 
AND a.question_id = ? 
ORDER BY a.create_date
ASC'
);
$answers_query->execute(array($_REQUEST['id']));
$answers = $answers_query->fetchAll();
// var_dump($answers);

// セッションに質問のidを保存（回答作成画面に質問内容を表示させるため）
$_SESSION['question_id'] = $_REQUEST['id'];
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
      <div class="flex justify-between mb-4">
        <div>
          <time class="text-sm mb-2">
            投稿日時：
            <?php echo htmlspecialchars($question['create_date']); ?>
          </time>
          <h2 class="font-bold text-xl">
            投稿者：
            <?php echo htmlspecialchars($question['nickname']); ?>
          </h2>
        </div>
        <!-- ログインしているIDと質問のユーザーIDが合致する質問のみに削除ボタンを表示 -->
        <?php if ($_SESSION['id'] == $question['user_id']) : ?>
          <div>
            <a href="./delete?id=<?php echo htmlspecialchars($question['id']) ?>" class="text-red-500 text-sm font-bold hover:underline block">
              質問を削除する
            </a>
          </div>
        <?php endif; ?>
      </div>
      <p>
        <?php echo mb_strimwidth(htmlspecialchars($question['body']), 0, 300, '...'); ?>
      </p>
      <div class="flex flex-col mt-12">
        <a href="<?php echo $root_pass; ?>answers/add" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold text-center block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          回答する
        </a>
        <a href="<?php echo $root_pass; ?>questions" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">質問一覧に戻る</a>
      </div>
    </div>
  <?php else : ?>
    <p class="max-w-4xl mx-auto py-5">
      投稿は削除されたか、見つかりません
    </p>
  <?php endif; ?>
  <!-- 以下回答一覧 -->
  <?php foreach ($answers as $answer) : ?>
    <?php if (!$answer['delete_flag'] == true) : ?>
      <div class="bg-white rounded-lg shadow-lg max-w-4xl mx-auto p-4 mt-12">
        <div class="flex justify-between mb-4">
          <div>
            <time class="text-sm mb-2">
              回答日時：
              <?php echo htmlspecialchars($answer['create_date']); ?>
            </time>
            <h2 class="font-bold text-xl">
              回答者：
              <?php echo htmlspecialchars($answer['nickname']); ?>
            </h2>
          </div>
          <!-- ログインしているIDと質問のユーザーIDが合致する質問のみに削除ボタンを表示 -->
          <?php if ($_SESSION['id'] == $answer['user_id']) : ?>
            <div>
              <a href="../answers/delete?id=<?php echo htmlspecialchars($answer['id']) ?>" class="text-red-500 text-sm font-bold hover:underline block">
                回答を削除する
              </a>
            </div>
          <?php endif; ?>
        </div>
        <p>
          <?php echo mb_strimwidth(htmlspecialchars($answer['body']), 0, 300, '...'); ?>
        </p>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>