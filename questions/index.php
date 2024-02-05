<?php
// ディレクトリ階層に合わせてファイルパスを定義
$root_pass = '../';
// ヘッダー
$pageTitle = 'Yahoo!知恵袋の様な掲示板サイト';
require_once($root_pass . 'template/header.php');
?>

<!-- 投稿カード -->
<div class="container mx-auto my-8">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- カードの例 -->
        <div class="bg-white rounded-lg shadow-lg p-4">
            <h2 class="font-bold text-xl mb-2">投稿タイトル</h2>
            <p>ここに投稿の内容が入ります。これは例です。</p>
        </div>
        <!-- 繰り返し -->
    </div>
</div>

<?php
// フッター
require_once($root_pass . 'template/footer.php');
?>