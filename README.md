# アプリ名：fashionably-late-contact-form

## 1. 環境構築(Setup Guide)

-以下の手順に従って、ローカル環境でのビルドおよび初期設定を行ってください。
### **GitHubからリポジトリをクローン**
    ```git clone git@github.com:AliettaA/fashionably-late-contact-form.git```
    ```cd fashionably-late-contact-form```
#### **Dockerコンテナのビルドと起動**
    プロジェクトのルートディレクトリで実行します。
    ```docker-compose up -d --build```
### **依存関係のインストール (Composer)**
    PHPコンテナ内でライブラリをインストールします。
    ```docker-compose exec php composer install```
### **環境変数の設定**
    .env.example をコピーして .env を作成し、アプリケーションキーを生成します。
    ```cp .env.example .env```
    ```docker-compose exec php php artisan key:generate```
### **データベースの構築とダミーデータの投入**
    マイグレーションの実行と、シーディングによる35件のテストデータの投入を一括で行います。
    ```docker-compose exec php php artisan migrate:fresh --seed```

## 2. 使用技術（実行環境）

本プロジェクトで使用している主要な技術スタックは以下の通りです。

フレームワーク / 言語
・Laravel: 8.3
・PHP
・HTML / CSS
・JavaScript: Vanilla JS (Modal & Form control)

インフラ / 実行環境
・Docker / docker-compose: ローカル開発環境のコンテナ化
・Nginx: nginx:1.21.1 Webサーバー
・MySQL: 8.0.26 データベース

外部ライブラリ / フォント
・Google Fonts: Gideon Roman (Logo & Headings)
・Sanitize.css: スタイルリセット

## 3. ER図
![ER図](./src/docs/fashinably-late.png)

## ４. URL
**ユーザー側（お問い合わせフォーム）**: (http://localhost/)
**管理者側（ログイン画面）**: (http://localhost/login)
**管理者側（ユーザー登録）**: (http://localhost/register)
**phpMyAdmin**: (http://localhost:8080/)