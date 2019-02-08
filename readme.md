#UKK Restoran (Laravel)

Server Requirement (Laravel 5.0)
PHP >= 5.4, PHP < 7
Mcrypt PHP Extension
OpenSSL PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension

How to use this

1. Download and install xampp with above requirement
2. Download composer
3. Clone this project 
4. Open your cmd and set path to this project
5. Import laravel-ppob.sql in phpmyadmin
6. Copy .env.example to .env and set mysql connection
7. Run "composer install"
8. Run "php artisan key:generate"
9. Run "php artisan serve" 
10. Open your browser and go localhost:8000
11. Enjoy

Route
1. localhost:8000/admin -> Manager
1. localhost:8000/teller -> Teller
1. localhost:8000/ -> Customer

Account
1. Manager : user = aome, password = aome
2. Teller : user = scarlet, password = scarlet
3. Customer : user = alfian, password = alfian