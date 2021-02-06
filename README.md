# Тестовая работа - CRUD Front Controller
Приложение реализует методы CRUD с использованием шаблона проектирования Front Controller

## Структура

* Зависимости: PHP 7.4, MariaDB 15.1, Composer 1.6
* Composer-пакеты: [robmorgan/phinx](https://github.com/cakephp/phinx "Phinx"), [fenom/fenom](https://github.com/fenom-template/fenom "Fenom"), [fzaninotto/faker](https://github.com/fzaninotto/Faker "Faker")

## Использование

Настройки для работы с БД находятся в файле /phinx.php (в корне проекта). Данный файл является конфигурацией для сервиса миграций Phinx. Сервис поддерживает исполнение миграций в нескольких средах окружения: `development`, `testing`, `production`. В зависимости от среды устанавливаются соответствующие настройки подключения к БД.

1. Скачать проект:
```bash
$: git clone https://github.com/SedovSG/testCRUD.git
```

2. Создать БД и выставить соответствующие настройки в файле конфигурации Phinx.

3. Собрать проект:
```bash
$: cd testCRUD && make setup
```

4. URL для запуска проекта: [localhost:8081](http://localhost:8001)
