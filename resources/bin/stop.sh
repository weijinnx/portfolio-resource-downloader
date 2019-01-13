#!/bin/bash

loudlog="./resources/bin/loud-log.sh"

${loudlog} "Stoping local server..."
docker-compose stop nginx mysql downloader
