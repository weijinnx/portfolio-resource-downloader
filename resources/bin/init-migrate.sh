#!/bin/bash

loudlog="./resources/bin/loud-log.sh"

${loudlog} "Starting init migration..."
docker-compose run --rm downloader php artisan migrate:fresh
docker-compose run --rm downloader php artisan db:seed
