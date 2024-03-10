# 概要  
Yahoo!知恵袋を参考に掲示板サイトを作成

> ログイン画面

![掲示板アプリのログイン画面](./assets/img/login.jpg)

> 質問一覧画面

![掲示板アプリの質問一覧画面](./assets/img/questions.jpg)

# 使用技術
![PHP 7.2](https://img.shields.io/badge/PHP-7.2-777BB4.svg?style=flat-square&logo=php)
![JavaScript](https://img.shields.io/badge/Javascript-276DC3.svg?logo=javascript&style=flat)
![MySQL 5.7](https://img.shields.io/badge/MySQL-5.7-4479A1.svg?style=flat-square&logo=mysql)
![Docker](https://img.shields.io/badge/Docker-Docker--compose-2496ED.svg?style=flat-square&logo=docker) 

# 掲示板の機能一覧
- 会員登録 
- ログイン、ログアウト 
- ニックネームの変更 
- パスワード更新 
- 投稿
- 投稿の削除
- 投稿に対する回答
- 回答の削除

# 環境構築

> Dockerのインストール
  
**※インストール済みの方は飛ばしてください。**

[Dockerをインストールする](https://www.docker.com/)

> Dockerコンテナ起動

```
docker-compose up -d
```

> Tailwind.css起動（実行しないとHTMLにclassを指定してもCSSが反映されません）

```
npm start
```

> Yahoo!知恵袋の様な掲示板サイトへのアクセス

```
http://localhost:8000/questions
```

> phpMyAdminへのアクセス

```
http://localhost:8080
```