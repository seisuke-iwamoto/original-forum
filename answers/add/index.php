<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'dbconect.php');
session_start();

// ログインしているか確認
if (isset($_SESSION['id'])) {

  // 確認画面からエラーの受け取りと削除
  if (isset($_SESSION['errors'])) {
    $_POST['answers_body'] = $_SESSION['answers_body'];
    // セッションに 'errors' が存在する場合、その値を $errors に代入
    $errors = $_SESSION['errors'];
  } else {
    // セッションに 'errors' が存在しない場合、$errors を空の配列に設定
    $errors = [];
  }
  // 確認画面から受け取ったエラーのセッションを削除
  unset($_SESSION['errors']);

  // 質問のIDと合致する質問文をDBから取得
  $questions_query = $db->prepare('SELECT q.* FROM questions q WHERE q.id=?');
  $questions_query->execute(array($_SESSION['question_id']));
  $question = $questions_query->fetch();

  // 表示している質問に対しての回答数をDBから取得
  $answer_count = $db->prepare(
    'SELECT COUNT(*) 
  AS answer_count 
  FROM answers 
  WHERE 
  question_id = ?
  AND
  (delete_flag IS NULL OR delete_flag != 1)
  '
  );
  $answer_count->execute(array($_SESSION['question_id']));
  $answer_total = $answer_count->fetch();

  // 質問に対して回答数が100件を超えていたら質問詳細画面にリダイレクトしてエラー表示
  if ($answer_total['answer_count'] > 100) {
    $answer_limit_over = '回答数が上限を超えているため回答することができません';
    $_SESSION['answer_limit_over'] = $answer_limit_over;
    // 質問詳細画面のURLを変数に格納
    $question_url = '../../questions/view.php?id=' . $_SESSION['question_id'];
    header('Location:' . $question_url);
    exit();
  }

  // 確認画面から入力画面に戻った際に入力内容を再現
  if ($_REQUEST['action'] == 'rewrite') {
    $_POST['answers_body'] = $_SESSION['answers_body'];
    $error['rewrite'] = true;
  }
} else {
  // ログインしてなければログイン画面へ
  header('Location: ../../login/');
  exit();
}
?>

<?php
// ヘッダー
$page_title = '回答作成画面';
require_once($root_pass . 'template/header.php');
?>

<!-- 回答作成画面 -->
<div class="flex items-center justify-center container mx-auto my-8">
  <div class="w-3/5 mx-auto bg-white rounded-lg shadow-lg p-6">
    <h2 class="font-bold text-xl mb-6">回答作成画面</h2>
    <form action="check.php" method="POST">
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-1">質問内容</label>
        <div class="border-l-4 border-gray-200 pl-6 my-3">
          <div class="py-4">
            <?php echo htmlspecialchars($question['body'], ENT_QUOTES); ?>
          </div>
        </div>
      </div>
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-1">回答内容</label>
        <textarea id="body" name="answers_body" class="shadow appearance-none border rounded w-full h-96 py-2 px-3 text-gray-700 leading-normal focus:outline-none focus:shadow-outline" placeholder="1000文字以内で回答内容を入力してください"><?php echo htmlspecialchars($_POST['answers_body'], ENT_QUOTES); ?></textarea>
        <div class="flex items-center justify-end text-gray-400 text-sm mt-2">
          あと
          <span id="count" class="text-black text-base font-bold mx-1">1000</span>
          文字まで入力できます
        </div>
        <?php if ($errors) : ?>
          <p class="text-red-500 font-bold text-sm text-right py-2"><?php echo htmlspecialchars($errors['answers_body'], ENT_QUOTES); ?></p>
        <?php endif; ?>
      </div>
      <div class="flex flex-col">
        <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          回答内容を確認する
        </button>
        <a href="<?php echo $root_pass; ?>questions/view.php?id=<?php echo htmlspecialchars($val) ?>" class="bg-gray-100 hover:bg-gray-300 duration-300 text-black font-bold text-center block py-2 px-4 mt-4 rounded focus:outline-none focus:shadow-outline">質問に戻る</a>
      </div>
    </form>
  </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>