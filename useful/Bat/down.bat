@echo off
@REM Демлать бэкап БД
set "file=%~dp0data\backup\down-local.sql"
docker exec mysql sh -c "exec mysqldump --databases bitrix -uroot -p\"root\"" > "%file%"
@REM *** *** ***
@REM работа с гитом - все текущие изменения в коммит и отправка на сервер всех изменений
docker-compose down
git add .
git commit -m "docker down"
git push --all