## description 
Test console command Symfony

clone\download this project
run in terminal
Steps on Windows 11 was: 
```bash
composer install

symfony server:ca:install
symfony server:start
````
then u can go on local page https://127.0.0.1:8000/
just check it's work or not

if everything ok
run the command in terminal
```bash
php bin/console console:count-prices-in-categories 
````
for test use this
```bash
vendor/bin/phpunit .\tests\TestConsole\testPrices.php
````