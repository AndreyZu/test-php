#Тест PHP

Решение находится в файле index.php

## Задание:

* Разобраться как устроены и что делают компоненты MyLogger и PDOAdapter, добавить комментарии.

>Для PDOAdapter можно не анализировать метод getColumnMetadata.

* Проанализировать структуру таблицы person тестовой базы данных.
* Написать тестовое приложение, используя компоненты MyLogger и PDOAdapter.

>Параметр $dsn компонента PDOAdapter имеет подобную структуру:
>$dsn = 'mysql:host=localhost;dbname=test'

* Написать запросы к базе данных, результат представить в виде самой простой HTML-страницы.

## Подробно:

Используя SQL и компонент PDOAdapter:

1. Определить максимальный возраст
2. Найти любую персону, у которой mother_id не задан и возраст меньше максимального
3. изменить у нее возраст на максимальный
4. Получить список персон максимального возраста (фамилия, имя). Желательно НЕ ИСПОЛЬЗУЯ полученное на шаге 1 значение.
5. Сформировать и отобразить HTML-страницу:

>Заголовок "Список персон максимального возраста (здесь значение п.1)"
>Таблица, содержащая колонки: фамилия, имя, возраст.
>В строках таблицы - персоны, упорядоченные по возрастанию фамилии и имени.

>Поощряется использование любых НЕОДУШЕВЛЕНЫХ информационных источников.
>Задание должно быть выполнено самостоятельно.
