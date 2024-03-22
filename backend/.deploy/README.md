# Бэкенд окружение
При запуске окружения разворачиваются следующие сервисы:
- [Laravel](https://laravel.com/) - фреймворк для разработки веб-приложений с использованием PHP
- [PostgreSQL](https://www.postgresql.org/) - объектно-реляционная система управления базами данных
- [Adminer](https://www.adminer.org/) - инструмент для управления базами данных
- [Nginx](https://www.nginx.com/) - HTTP-сервер и обратный прокси-сервер
- [Centrifugo](https://centrifugal.dev) - инструмент для управления вэбсокетами

## Настройка
В `.env.example` прописаны все переменные, которые необходимо заполнить для работы окружения.

Общие переменные:
* `LOCAL_USER` - имя пользователя, владелец контейнеров
* `DB_NAME` - имя базы данных
* `DB_USERNAME` - имя пользователя базы данных
* `DB_PASSWORD` - пароль пользователя базы данных
* `NGINX_SERVER` - адрес сервера, на котором будет работать приложение
* `PROXY_PORT` - порт, на котором будет работать приложение
* `CENTRIFUGO_TOKEN_HMAC_SECRET_KEY` - токен hmac для centrifugo
* `CENTRIFUGO_ADMIN_PASSWORD` - пароль для админ панели centrifugo
* `CENTRIFUGO_API_KEY` - api ключ для centrifugo
* `CENTRIFUGO_ADMIN_SECRET` - токен секрета для админского входа centrifugo
* `ALLOWED_ORIGINS` - разрешенные источники запросов для centrifugo

Переменные только для локального окружения:
* `DB_PORT` - порт, для доступа к бд вне контейнеров (на хост машине)

## Запуск
Для запуска окружения необходимо:
* Перейти в папку в зависимости от окружения (local, prod)
* Скопировать файл `.env.example` в `.env` и заполнить переменные
* Выполнить команду `docker compose up -d`

После запуска окружения в зависимости от установленного порта (`localhost:<PROXY_PORT>`) приложения будут доступны:
* [http://localhost/api](http://localhost/api) - бэкенд
* [http://localhost/adminer](http://localhost/adminer) - Управление базой данных (только для локального окружения)
* [http://localhost/centrifugo](http://localhost/centrifugo) - Админ панель вэбсокетов

## Об окружении для разработки
Для корректной работы после запуска окружения необходимо:
* Перейти в контейнер с приложением: `docker compose exec backend sh`
* Выполнить команду `composer install`

## Тестирование
Для выполнения UNIT тестов необходимо:
* Перейти в директорию test 
```bash 
cd ./test
```
* (Необязательно) Скопировать и заполнить .env (используйте любимый редактор) 
```bash
cp .env.example .env
nvim .env
```
* Запустить docker compose 
```bash
docker compose up --exit-code-from backend-test --always-recreate-deps
```

После успешной сборки и выполнения контейнеров в терминале выведется код выполнения тестов и весь процесс.
Рекомендуется также после завершения выполнить команду для удаления контейнеров 
```bash
docker compose down
```