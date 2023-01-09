#!/bin/bash

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

docker exec test1-mysql sh -c 'exec mysqldump --databases local -uroot -p"$MYSQL_ROOT_PASSWORD"' > "$CURRENT_DIR/docker/data/backup/local.sql"

docker-compose down