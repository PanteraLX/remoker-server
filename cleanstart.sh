#!/usr/bin/env bash

rm -Rf app/cache app/logs app/bootstrap.php.cache
rm composer.lock
composer install