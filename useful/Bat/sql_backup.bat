@echo off
echo "%~dp0"
REM Получение текущей даты и времени
set "year=%date:~6,4%"
set "month=%date:~3,2%"
set "day=%date:~0,2%"
set "hour=%time:~0,2%"
REM Формирование строки вида "год-месяц-день-час"
set "timestamp=%year%-%month%-%day%_%hour%"
set "file=%~dp0data\backup\%timestamp%-local.sql"
echo %file%
docker exec mysql sh -c "exec mysqldump --databases bitrix -uroot -p\"root\"" > "%file%"