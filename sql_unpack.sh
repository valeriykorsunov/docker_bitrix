#!/bin/bash

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

docker exec mysql sh -c 'exec mysql --databases bitrix -uroot -p"root"' < "$CURRENT_DIR/data/backup/local.sql"
