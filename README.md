## Тестовое div.

Для решения тестового использовались перечисленные инструменты:

- PHP 8.1
- Laravel 10
- MySQL 5.7
- tymon/jwt-auth, для реализации юзеров через jwt.
- darkaonline/l5-swagger, для реализации документации.

Для запуска проекта:

 1. git clone git@github.com:Hauda15/testovoe-div.git
 2. composer install
 3. В .env вписать данные для подключения к локальной базе, почтовый драйвер log для складывания почты в лог.
 4. php artisan migrate
 5. php artisan jwt:secret
 6. php artisan l5-swagger:generate
 7. php artisan serve
Поднял бы на хост с nginx-ом, но жалко 200 рублей. :(
