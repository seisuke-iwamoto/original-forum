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

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="<?php echo $root_pass; ?>assets/css/style.css?<?php echo time(); ?>">
  <script defer src="<?php echo $root_pass; ?>assets/js/script.js"></script>
</head>

<body class="bg-gray-100">
  <div class="grid grid-rows-[auto_1fr_auto] grid-cols-1 min-h-screen">
    <header class="py-4">
      <div class="bg-white shadow-md rounded-full py-4 px-8 mx-auto container flex justify-between items-center">
        <div class="logo">
          <h1 class="text-black">
            <a href="<?php echo $root_pass . 'questions/'; ?>" class="hover:opacity-70">Yahoo!知恵袋の様な掲示板サイト</a>
          </h1>
        </div>
        <nav>
          <ul class="flex gap-2 items-center">
            <?php if (isset($_SESSION['id'])) : ?>
              <li>
                <a class="hover:underline  text-black flex flex-col gap-2 items-center" href="<?php echo $root_pass; ?>">
                  マイページ
                </a>
              </li>
              <li>
                <a class="hover:underline  text-black block py-2 px-4 rounded" href="<?php echo $root_pass; ?>logout/">ログアウト
                </a>
              </li>
            <?php else : ?>
              <li>
                <a class="hover:underline text-black block py-2 px-4 rounded" href="<?php echo $root_pass; ?>login/">
                  ログイン
                </a>
              </li>
              <li>
                <a class="bg-[#fc7f11] hover:bg-[#fd9f4d] duration-300 text-white block py-2 px-4 rounded" href="<?php echo $root_pass; ?>users/add">新規登録
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </header>