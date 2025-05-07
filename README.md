# UserAPI - функционал для работы с пользователями через API

## Описание

UserAPI - функционал для взаимодействиями с пользователями через апи, позволяет просматривать, добавлять 
новых пользователей.

## Возможности

*   Создание и получение пользователей через api
*   загрузка фотографий с оптимизацией через сервис tinypng.
*   возможность создавать пользователей через фабрику

## Установка

Для установки и запуска приложения необходимо выполнить следующие шаги:

### Предварительные требования

*   apache 2.4
*   php 8.1
*   mySQL 8
*   composer 

### Инструкция по установке

1.  Клонируйте репозиторий:

    ```bash
    git clone https://github.com/kapeks/UserAPI.git
    ```

2.  в корне проекта выполните установку composer:

    ```bash
    composer install
    ```

3. (Опционально) создайте файл в корне проекта `.env` Скопируйте файл `.env.example` в `.env` и настройте переменные окружения:

    пример:

    DB_HOST=localhost

    DB_PORT=3306

    DB_DATABASE=UserAPI

    DB_USERNAME=root
    
    DB_PASSWORD=

    QUEUE_CONNECTION=database

    APP_URL=http://example.com

    API_KEY_TINIFY=lMRrmbDljlf7fdrGzYt9cgV196bDfgh  (нужно создать свой уникальный ключ на сайте  https://tinypng.com/)

4.  Настройте базу данных MySQL:

    ```bash
    php artisan migrate
    ```
5.  Наполните базу данных пользователями, если это нужно

    ```bash
    php artisan migrate --seed
    ```
6.  запустить воркер

    ```bash
    php artisan queue:work
    ```
### Примеры Api запросов

1. get http://example.com/api/users - возвращает всех пользователей
2. get http://example.com/api/users/{1} - возвращает пользователя по ид
3. get http://example.com/api/position - возвращает возможные должности
4. get http://example.com/api/token - возвращает токен доступа 
5. post http://example.com/api/users - добавление пользователя:
name *
email *
phone *
position_id *
photo *

[MIT](LICENSE)

## Контакты

**Email:** scalp.profit@gmail.com
