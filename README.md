1. composer install

2. Создайте базу данных с помощью файла shorturl.sql 

3. Настройте подключение в файле config.php в корне проекта 

4. Дайте права на запись views/templates_c

5. Запуск юнит-тестов из корневой директории проекта

./vendor/bin/phpunit unitTests/UrlController_createShortUrlTest.php

./vendor/bin/phpunit unitTests/UrlController_getRealUrlTest.php

./vendor/bin/phpunit unitTests/StatisticController_getStatTest.php

./vendor/bin/phpunit unitTests/StatisticController_getStatDataTest.php

В базе есть одно значение, специально для юнит тестов.