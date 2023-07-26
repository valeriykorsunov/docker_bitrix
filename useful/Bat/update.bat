@echo off
@REM --------------------------------------------------------------------------------------------
@REM Скрипт поможет собрать все файлы из последнего коммита в одну папку(директориии сохраняются)
@REM --------------------------------------------------------------------------------------------
setlocal enabledelayedexpansion
REM Получение текущей даты и времени
set "datetime=%DATE%_%TIME%"
REM Замена недопустимых символов в имени файла
set "datetime=%datetime:/=-%"
set "datetime=%datetime::=-%"
set "datetime=%datetime:.=-%"
set "datetime=%datetime:,=-%"
REM Удаление пробелов в начале имени файла (если есть)
set "datetime=%datetime: =%"
REM Используйте переменную %datetime% в качестве имени файла
echo %datetime%
set folder=%~dp0data\update\%datetime%
set folder=%folder:/=\%
@REM Создаем папку "up22" в директории, где находится исполняемый .bat файл
mkdir "%folder%"
@REM Получаем список файлов, содержащих изменения за последний коммит
for /f "delims=" %%x in ('git diff --name-only HEAD~1 HEAD') do (
    @REM Заменяем слеши в пути к файлу на обратные слеши
    set file=%%x
    set file=!file:/=\!
    @REM echo "%folder%\!file!"
	echo F | xcopy "!file!" "%folder%\!file!" /Y /I
)
endlocal