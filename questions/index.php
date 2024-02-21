<?php
ob_start();
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../';
require($root_pass . 'dbconect.php');
session_start();

// 質問の投稿情報を取得
$posts_query = $db->query('SELECT u.nickname, q.* FROM users u, questions q WHERE u.id=q.user_id ORDER BY q.create_date DESC');
$posts = $posts_query->fetchAll(); //SQL文の結果を全て取り出し
?>

<?php
// ヘッダー
$page_title = 'Yahoo!知恵袋の様な掲示板サイト';
require_once($root_pass . 'template/header.php');
?>

<!-- 質問一覧 -->
<div class="container mx-auto my-8">
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($posts as $post) : ?>
            <li class="bg-white rounded-lg shadow-lg p-4">
                <a href="#" class="block hover:opacity-70 duration-300">
                    <time class="text-sm mb-2">
                        投稿日時：
                        <?php echo htmlspecialchars($post['create_date']); ?>
                    </time>
                    <h2 class="font-bold text-xl mb-2">
                        投稿者：
                        <?php echo htmlspecialchars($post['nickname']); ?>
                    </h2>
                    <p>
                        <?php echo mb_strimwidth(htmlspecialchars($post['body']), 0, 300, '...'); ?>
                    </p>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>