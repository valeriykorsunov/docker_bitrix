@echo off
setlocal enabledelayedexpansion
set folder=%~dp0up22
set folder=%folder:/=\%
@REM Создаем папку "up22" в директории, где находится исполняемый .bat файл
mkdir "%folder%"
@REM Получаем список файлов, содержащих изменения за последние 3 коммита
for /f "delims=" %%x in ('git diff --name-only HEAD~1 HEAD') do (
    @REM Заменяем слеши в пути к файлу на обратные слеши
    set file=%%x
    set file=!file:/=\!
    echo "%folder%\!file!"
	echo F | xcopy "!file!" "%folder%\!file!" /Y /I
)
endlocal