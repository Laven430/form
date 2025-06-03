#お問い合わせフォーム
##環境構築
'''
Dokerビルド
'''
 1.git clone git@github.com:coachtech-material/laravel-docker-template.git
 2.docker-compose up -d --build
'''
Laravel環境構築
'''
 1.docker-compose exec php bash
 2.composer install
 3..env.example ファイルから.envを作成し、環境変数を変更
 4.php artisan key:generate
 5.php artisan migrate
 6.php artisan db:seed
'''
##使用技術
・PHP 7.4.9
・Laravel 8.83.8
・Mysql 8.0
'''
(![スクリーンショット 2025-06-03 211254](https://github.com/user-attachments/assets/7d80f7b2-6459-43f0-adb0-a298235a1a81))
'''
##URL
・開発環境：http://localhost/
・phpMyAdmin：http://localhost:8080/
