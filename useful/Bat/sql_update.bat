@echo off
@REM echo "%~dp0"
type "%~dp0data\backup\local.sql" | docker exec -i mysql /usr/bin/mysql -u root --password=root bitrix