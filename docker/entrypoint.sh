#!/bin/sh

#On error no such file entrypoint.sh, execute in terminal - dos2unix .docker\entrypoint.sh --env=test
composer install
php bin/console doctrine:migrations:migrate --no-interaction

# php -S 0.0.0.0:8000 -t public
php-fpm