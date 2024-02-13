<?php
session_start();
$username = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_title; ?></title>
  <link rel="stylesheet" href="<?php echo $root_pass; ?>assets/css/style.css?<?php echo time(); ?>">
  <script defer src="<?php echo $root_pass; ?>assets/js/script.js?<?php echo time(); ?>"></script>
</head>

<body class="bg-gray-100">
  <div class="grid grid-rows-[auto_1fr_auto] grid-cols-1 min-h-screen">
    <header class="my-4 h-20">
      <div class="bg-white shadow-md rounded-full h-[inherit] px-8 mx-auto container flex justify-between items-center">
        <div class="logo">
          <h1 class="text-black">
            <a href="<?php echo $root_pass . 'questions/'; ?>" class="hover:opacity-70">Yahoo!知恵袋の様な掲示板サイト</a>
          </h1>
        </div>
        <nav class="h-[inherit]">
          <ul class="flex items-center h-[inherit]">
            <?php
            // ログインしている時
            if (isset($_SESSION['id'])) :
            ?>
              <li class="h-[inherit]">
                <a class="hover:underline  text-black flex items-center justify-center h-[inherit] px-4" href="<?php echo $root_pass; ?>questions/add/">
                  質問を作成する
                </a>
              </li>
              <li class="h-[inherit]">
                <a class="hover:underline  text-black flex items-center justify-center h-[inherit] px-4" href="<?php echo $root_pass; ?>users/mypage/">
                  マイページ
                </a>
              </li>
              <li id="dropDownMenu" class="relative h-[inherit]">
                <a href="#" class="hover:underline text-black flex items-center justify-center h-[inherit] px-4 rounded">設定</a>
                <ul class="hidden absolute -bottom-20 left-0 bg-white shadow-md min-w-max">
                  <li><a href="<?php echo $root_pass; ?>users/edit" class="hover:underline text-black block py-2 px-4">ユーザー名変更</a></li>
                  <li><a href="<?php echo $root_pass; ?>users/password" class="hover:underline text-black block py-2 px-4">パスワード更新</a></li>
                </ul>
              </li>
              <li class="h-[inherit]">
                <a class="hover:underline  text-black flex items-center justify-center h-[inherit] px-4 rounded" href="<?php echo $root_pass; ?>logout/">ログアウト
                </a>
              </li>
            <?php 
            // ログインしていない時
            else : 
            ?>
              <li class="h-[inherit]">
                <a class="hover:underline text-black flex items-center justify-center h-[inherit] px-4 rounded" href="<?php echo $root_pass; ?>login/">
                  ログイン
                </a>
              </li>
              <li>
                <a class="bg-[#fc7f11] hover:bg-[#fd9f4d] duration-300 text-white block py-2 px-4 mx-4 rounded" href="<?php echo $root_pass; ?>users/add">新規登録
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </header>