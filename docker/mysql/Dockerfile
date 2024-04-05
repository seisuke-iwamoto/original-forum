# MySQLの公式イメージをベースに使用
FROM mysql:5.7

# 文字コードの設定ファイルをコピー
COPY ./docker/mysql/my.cnf /etc/mysql/conf.d/my.cnf

# 初期化スクリプトをイメージ内に追加
COPY ./db /docker-entrypoint-initdb.d
