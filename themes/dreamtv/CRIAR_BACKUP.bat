@echo off
title Criar Backup Local - DreamTV
color 0A

echo.
echo ========================================================================
echo                    CRIAR BACKUP LOCAL - DREAMTV
echo ========================================================================
echo.

set timestamp=%date:~-4%%date:~3,2%%date:~0,2%_%time:~0,2%%time:~3,2%%time:~6,2%
set timestamp=%timestamp: =0%

set backup_file=index.php.backup_%timestamp%

echo [*] Criando backup de index.php...
echo.
echo Arquivo: %backup_file%
echo.

copy "index.php" "%backup_file%" >nul

if %ERRORLEVEL%==0 (
    echo [OK] Backup criado com sucesso!
    echo.
    echo Local: C:\xampp\htdocs\webplayer_dev\themes\dreamtv\%backup_file%
) else (
    echo [ERRO] Falha ao criar backup!
)

echo.
echo ========================================================================
echo.
pause
