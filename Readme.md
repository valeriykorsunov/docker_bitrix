# Сервер для разрпботки и тестирования проектов на php

## ./down.sh

Команда выполнит:

* бэкап БД.
* docker-compose down
* добавит все изменения в гит
* сделает коммит = "docker dwn"
* отправит коммит


## pre-commit

Перед коммитом делает бэкап БД: data/backup/backup_db_git.sql 

для работы скопировать файл в папку .git/hooks
