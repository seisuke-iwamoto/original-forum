<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../';
require($root_pass . 'config/dbconect.php');
session_start();

// ページャー用に現状のページ数を取得し変数に格納
$page = $_REQUEST['page'];
if ($page == '') {
    $page = 1;
}
//$pageと１を比較して大きい方を$pageに格納
$page = max($page, 1);

// 質問の総数を取得
$counts = $db->query('SELECT COUNT(*) AS cnt FROM questions');
$cnt = $counts->fetch();
// 質問総数を1ページあたりに表示する質問数で割りページ数を算出（繰り上げ）
$maxPage = ceil($cnt['cnt'] / 9);
// $pageの値が実際の総ページ数より大きい場合に実際の総ページを返す
$page = min($page, $maxPage);
// ページ数から１を引いて1ページあたりに表示する質問数をかけて各ページのスタート位置を算出する
$start = ($page - 1) * 9;
// $startが1の時は0を返す（質問が1つしか無い時に質問が表示されない対策）
$start = max($start, 0);

// $startの数値から1ページあたりに必要な質問数を取得
$questions = $db->prepare('SELECT u.nickname, q.* FROM users u, questions q WHERE u.id=q.user_id ORDER BY q.create_date DESC LIMIT ?, 9');
$questions->bindValue(1, $start, PDO::PARAM_INT);
$questions->execute();
?>

<?php
// ヘッダー
$page_title = 'Yahoo!知恵袋の様な掲示板サイト';
require_once($root_pass . 'template/header.php');
?>

<!-- 質問一覧 -->
<div class="container mx-auto my-8">
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($questions as $question) : ?>
            <!-- delete_flagがtrueでない質問のみ表示 -->
            <?php if (!$question['delete_flag'] == 1) : ?>
                <li class="bg-white rounded-lg shadow-lg p-4">
                    <a href="/questions/<?php echo htmlspecialchars($question['id']); ?>" class="block h-full hover:opacity-70 duration-300">
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
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <!-- ページャー -->
    <ul class="flex items-center justify-center gap-4 mt-8">
        <?php
        if ($page > 1) {
        ?>
            <li class="bg-blue-500 hover:bg-blue-700 duration-300 text-white inline-block p-2 rounded-md focus:outline-none focus:shadow-outline">
                <a href="index.php?page=<?php print($page - 1); ?>">前のページへ</a>
            </li>
        <?php
        }
        ?>
        <?php
        if ($page < $maxPage) {
        ?>
            <li class="bg-blue-500 hover:bg-blue-700 duration-300 text-white inline-block p-2 rounded-md focus:outline-none focus:shadow-outline">
                <a href="index.php?page=<?php print($page + 1); ?>">次のページへ</a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>