#!/bin/bash

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# не создает файла local.sql
# нужно настроить автоматическое создание нового файла с датой (год-месяц-день)
docker exec mysql sh -c 'exec mysqldump --databases bitrix -uroot -p"root"' > "$CURRENT_DIR/data/backup/local.sql"

docker-compose down