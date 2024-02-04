<?php
session_start();

$username = $_SESSION['name'];
if (isset($_SESSION['id'])) { //ログインしているとき
  // $msg = 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん';
  // $link = '<a href="logout.php">ログアウト</a>';
} else { //ログインしていない時
  // $msg = 'ログインしていません';
  // $link = '<a href="login.php">ログイン</a>';
}
?>
<h1><?php echo $msg; ?></h1>
<?php echo $link; ?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="../assets/css/style.css?<?php echo time(); ?>">
  <script defer src="../assets/js/script.js"></script>
</head>

<body class="bg-gray-100">
  <header class="py-4">
    <div class="bg-white shadow-md rounded-full py-4 px-8 mx-auto w-[95%] max-w-7xl flex justify-between items-center">
      <div class="logo">
        <h1 class="text-black">Yahoo!知恵袋の様な掲示板サイト</h1>
      </div>
      <nav>
        <ul class="flex gap-4 items-center">
          <?php if (isset($_SESSION['id'])) : ?>
            <li>
              <a class="hover:underline  text-black flex flex-col gap-2 items-center" href="#">
                マイページ
              </a>
            </li>
            <li>
              <a class="bg-gray-200 hover:bg-gray-400 duration-300 text-black block py-2 px-4 rounded" href="../logout/">ログアウト
              </a>
            </li>
          <?php else : ?>
            <li>
              <a class="bg-black hover:bg-[#404040] duration-300 text-white block py-2 px-4 rounded" href="../login/">
                ログイン
              </a>
            </li>
            <li>
              <a class="bg-[#fc7f11] hover:bg-[#fd9f4d] duration-300 text-white block py-2 px-4 rounded" href="../users/">新規登録
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>