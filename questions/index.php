<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Yahoo!知恵袋の様な掲示板サイト</title>
  <link rel="stylesheet" href="../dist/style.css">
</head>
<body class="bg-gray-100">

    <!-- ヘッダー -->
    <header class="bg-navy text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="logo">
                <h1 class="text-black">Yahoo!知恵袋の様な掲示板サイト</h1>
            </div>
            <div class="buttons">
                <button class="bg-black text-white py-2 px-4 rounded mr-2">ログイン</button>
                <button class="bg-white text-black py-2 px-4 rounded">新規登録</button>
            </div>
        </div>
    </header>

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
</body>
</html>