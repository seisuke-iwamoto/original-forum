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
  <div class="bg-white shadow-md rounded-full py-4 px-8 mx-auto max-w-7xl flex justify-between items-center">
    <div class="logo">
      <h1 class="text-black">Yahoo!知恵袋の様な掲示板サイト</h1>
    </div>
    <nav class="">
      <ul class="flex gap-3">
        <li class="">
          <a class="bg-black hover:bg-[#404040] duration-300 text-white block py-2 px-4 rounded mr-2" href="">ログイン</a>
        </li>
        <li class="">
          <a class="bg-[#fc7f11] hover:bg-[#fd9f4d] duration-300 text-white block py-2 px-4 rounded" href="../users/add/">新規登録</a>
        </li>
      </ul>
    </nav>
  </div>
</header>
