#!/bin/bash

docker-compose exec php /var/www/bin/console doctrine:database:create --if-not-exists
docker-compose exec php /var/www/bin/console doctrine:schema:update --force