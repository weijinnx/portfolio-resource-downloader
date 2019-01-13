#!/bin/bash

loudlog="./resources/bin/loud-log.sh"

${loudlog} "Pulling docker containers..."
docker-compose pull
