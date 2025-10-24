@echo off
title DreamTV - Ambiente LOCAL
color 0B

echo.
echo ========================================================================
echo                    DREAMTV - DESENVOLVIMENTO LOCAL
echo ========================================================================
echo.
echo [*] Verificando XAMPP...

REM Verifica se Apache esta rodando
tasklist /FI "IMAGENAME eq httpd.exe" 2>NUL | find /I /N "httpd.exe">NUL
if "%ERRORLEVEL%"=="0" (
    echo [OK] Apache ja esta rodando!
) else (
    echo [!] Apache nao esta rodando. Iniciando XAMPP...
    if exist "C:\xampp\xampp-control.exe" (
        start "" "C:\xampp\xampp-control.exe"
        echo [*] Aguardando Apache iniciar...
        timeout /t 5 /nobreak >nul
    ) else (
        echo [ERRO] XAMPP nao encontrado em C:\xampp\
        pause
        exit
    )
)

echo.
echo [*] Abrindo DreamTV no navegador...
echo.
echo ========================================================================
echo  URL LOCAL: http://localhost/webplayer_dev/themes/dreamtv/
echo ========================================================================
echo.

start "" "http://localhost/webplayer_dev/themes/dreamtv/"

echo.
echo [OK] Ambiente local configurado!
echo.
echo IMPORTANTE:
echo - Todas as alteracoes em index.php serao refletidas instantaneamente
echo - Pressione CTRL+F5 no navegador para forcar reload
echo - Quando aprovar as mudancas, use o script de upload para producao
echo.
pause
