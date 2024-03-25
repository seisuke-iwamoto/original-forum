# MySQLの公式イメージをベースに使用
FROM mysql:5.7

# 初期化スクリプトをイメージ内に追加
COPY ./mysql-init /docker-entrypoint-initdb.d
