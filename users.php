<?php
$pageTitle = '会員登録画面';
require_once('./template/header.php');
?>

  <!-- 会員登録フォーム -->
  <div class="container mx-auto my-8">
    <div class="max-w-sm mx-auto bg-white rounded-lg shadow-lg p-6">
      <h2 class="font-bold text-xl mb-4">会員登録</h2>
      <form action="#" method="POST">
        <div class="mb-4">
          <label for="username" class="block text-gray-700 text-sm font-bold mb-2">ユーザーネーム</label>
          <input type="text" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="ユーザーネーム">
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">パスワード</label>
          <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" placeholder="********">
        </div>
        <div class="flex items-center justify-between">
          <button class="bg-blue-500 hover:bg-blue-700 duration-300 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            送信
          </button>
          <a href="#" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 duration-300">
            既に会員の方はこちらから ログイン
          </a>
        </div>
      </form>
    </div>
  </div>
  
  <?php require_once('./template/footer.php'); ?>