#!/bin/bash

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

FNAME=$CURRENT_DIR/data/backup/docker_down.sql

# docker exec mysql sh -c 'exec mysqldump --databases bitrix -uroot -p"root"' > "$CURRENT_DIR/data/backup/local.sql"
docker exec mysql sh -c 'exec mysqldump --databases bitrix -uroot -p"root"' > "$FNAME"

docker-compose down

git add .

git commit -m "docker down"

git push