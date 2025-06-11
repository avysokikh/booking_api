# Hotel Booking API

RESTful API для системы бронирования гостиничных номеров, разработанное на Laravel.

## Функциональность

- Аутентификация пользователей
- Просмотр доступных номеров
- Бронирование номеров

## Требования

- PHP 8.1 или выше
- Composer
- SQLite или PostgreSQL

## Установка

1. Клонируйте репозиторий:
```bash
git clone <repository-url>
cd booking-api
```

2. Установите зависимости:
```bash
composer install
```

3. Создайте файл .env:
```bash
cp .env.example .env
```

4. Сгенерируйте ключ приложения:
```bash
php artisan key:generate
```

5. Настройте базу данных SQLite:
```bash
touch database/database.sqlite
```

6. Обновите .env файл:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

7. Запустите миграции:
```bash
php artisan migrate
```

8. Запустите сервер:
```bash
php artisan serve
```

## Переключение на PostgreSQL

1. Создайте базу данных PostgreSQL

2. Обновите .env файл:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

3. Запустите миграции:
```bash
php artisan migrate
```

## Заполнение тестовыми данными

Для заполнения базы данных тестовыми данными используйте сидеры:

1. Запустите все сидеры:
```bash
php artisan db:seed
```

2. Или запустите конкретные сидеры:
```bash
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RoomSeeder
php artisan db:seed --class=BookingSeeder
```

Тестовые данные включают:
- 10 пользователей с паролем 'password' и email 'user[1..10]@example.com'
- 5 номеров
- 30 бронирований с датами в 2025 году

## API Документация

Подробная документация API доступна в файле [API.yaml](API.yaml)

## Тестирование

Запустите тесты:
```bash
php artisan test
```
