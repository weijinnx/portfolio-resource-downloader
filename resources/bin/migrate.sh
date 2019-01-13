#!/bin/bash

loudlog="./resources/bin/loud-log.sh"

${loudlog} "Start migrating..."
docker-compose run --rm downloader php artisan migrate --force
