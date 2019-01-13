#!/bin/bash

loudlog="./resources/bin/loud-log.sh"

${loudlog} "Starting local server on http://localhost:2000/"
docker-compose up -d --remove-orphans nginx mysql downloader