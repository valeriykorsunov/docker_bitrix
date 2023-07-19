#!/bin/bash

CURRENT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Restore
cat "$CURRENT_DIR/data/backup/local.sql" | docker exec -i mysql /usr/bin/mysql -u root --password=root bitrix