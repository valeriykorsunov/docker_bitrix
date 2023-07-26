#!/bin/bash

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

FNAME=$CURRENT_DIR/data/backup/`date +%Y%m%d_%H%M%S`_backup_local.sql

docker exec mysql sh -c 'exec mysqldump --databases bitrix -uroot -p"root"' > "$FNAME"