FROM php:7.2-apache

# PDO MySQL 拡張のインストール
RUN docker-php-ext-install pdo_mysql

# Node.js のインストール
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get update \
    && apt-get install -y nodejs

# 作業ディレクトリの設定
WORKDIR /var/www/html

# Node.js 依存関係のコピーとインストール
COPY package.json package-lock.json ./
RUN npm install

# その他のプロジェクトファイルのコピー
COPY . .

# Tailwind CSS のビルド
RUN npm run build-css

EXPOSE 80
CMD ["apache2-foreground"]
