Даны два списка.
Список автомобилей и список пользователей.
C помощью laravel сделать api для управления списком использования автомобилей пользователями.
В один момент времени 1 пользователь может управлять только одним автомобилем. В один момент времени 1 автомобилем может управлять только 1 пользователь.

Код разместить на https://github.com/

Подготовить документацию в https://editor.swagger.io/

Обязательно наличие тестов.

---

1. Запуск проекта:

- `cp .env.example .env`
- `docker compose up -d`

2. Документация Swagger:
http://laravel.test/api/documentation

3. Запуск тестов:

`docker compose exec php-fpm php /var/www/artisan test`
