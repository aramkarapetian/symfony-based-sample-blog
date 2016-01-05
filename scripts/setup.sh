!#/bin/sh

php bin/console doctrine:database:create
chmod -R 0777 var/cache var/logs
php bin/console doctrine:schema:update --force