-- original_forum_dbという名前のDBが無い時だけDBを新規作成（文字コードをutf8mb4に設定）
CREATE DATABASE IF NOT EXISTS original_forum_db CHARACTER
SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- 以降の処理はoriginal_forum_dbを使用
USE original_forum_db;
-- usersテーブルとカラム作成
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  nickname VARCHAR(255) NOT NULL,
  creat_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARACTER
SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- 作成したテーブルにダミーデータを挿入
INSERT INTO users (username, password, nickname)
VALUES ('user', 'user', 'user');
-- questionsテーブル作成
CREATE TABLE IF NOT EXISTS questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  body TEXT NOT NULL,
  creat_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  delete_flag TINYINT(1) NOT NULL DEFAULT 0
) CHARACTER
SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- 作成したテーブルにダミーデータを挿入
INSERT INTO questions (user_id, body)
VALUES (1, 'This is a test question.');
-- answersテーブル作成
CREATE TABLE IF NOT EXISTS answers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  question_id INT NOT NULL,
  body TEXT NOT NULL,
  creat_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  delete_flag TINYINT(1) NOT NULL DEFAULT 0
) CHARACTER
SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- 作成したテーブルにダミーデータを挿入
INSERT INTO answers (user_id, question_id, body)
VALUES (1, 1, 'This is a test answer.');