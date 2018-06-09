**Установка проекта:**

1. Указать в файле конфигурации (.env) подключение к БД PostgreSQL
2. Создать БД
    ```
    bin/console doctrine:database:create
    ```
3. Применить миграции:
    ```
    bin/console doctrine:migrations:migrate
    ```
4. Заполнить начальными данными:
    ```
    bin/console doctrine:fixtures:load 
    ```
5. Собрать фронтенд статику
    ```
    yarn install
    yarn build
    ```
    