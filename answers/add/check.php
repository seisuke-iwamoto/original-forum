<?php
ob_start();
session_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../../';
require($root_pass . 'config/dbconect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // セッションに回答文を保存
  $_SESSION['answers_body']= $_POST['answers_body'];
  
  if (isset($_POST['answers_body'])) {
    $answer = $_POST['answers_body'];
  } else {
    $answer = '';
  }

  $errors = [];

  // パスワードのバリデーション
  if (empty($answer)) {
    $errors['answers_body'] = '回答文を入力してください';
  } elseif (mb_strlen($_POST['answers_body']) > 1000) {
    $errors['answers_body'] = '回答文は1000文字以内で入力してください';
  }

  // エラーがあればセッションに保存し、入力画面にリダイレクト
  if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: index.php');
    exit;
  }
}

// 質問のIDと合致する質問文をDBから取得
$questions_query = $db->prepare('SELECT q.* FROM questions q WHERE q.id=?');
$questions_query->execute(array($_SESSION['question_id']));
$question = $questions_query->fetch();
?>

<?php
// ヘッダー
$page_title = '回答内容確認画面';
require_once($root_pass . 'template/header.php');
?>

<div class="flex items-center justify-center container mx-auto my-8">
  <form action="thanks.php" method="POST" class="w-full mx-auto my-8">
    <div class="w-3/5 mx-auto bg-white rounded-lg shadow-lg p-6">
      <h2 class="font-bold text-xl mb-4">回答内容確認</h2>
      <div class="mb-4">
        <label for="username" class="block text-gray-700 text-sm font-bold mb-1">質問内容</label>
        <div class="border-l-4 border-gray-200 pl-6 my-3">
          <div class="py-4">
            <?php echo htmlspecialchars($question['body'], ENT_QUOTES); ?>
          </div>
        </div>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">回答内容</label>
        <div class="w-full min-h-48 py-2 px-3 text-gray-700 mb-3">
          <?php echo htmlspecialchars($_POST['answers_body'], ENT_QUOTES); ?>
        </div>
      </div>
      <div>
        <div class="flex flex-col">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold text-center block py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">回答を投稿する</button>
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