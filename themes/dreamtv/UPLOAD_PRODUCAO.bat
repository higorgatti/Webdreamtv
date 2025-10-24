@echo off
title Upload DreamTV para Producao
color 0E

echo.
echo ========================================================================
echo              UPLOAD DO TEMA DREAMTV PARA PRODUCAO
echo ========================================================================
echo.
echo Local:     C:\xampp\htdocs\webplayer_dev\themes\dreamtv\index.php
echo Servidor:  209.14.84.36
echo Destino:   /var/www/html/themes/dreamtv/
echo URL Final: http://play.fivetv5.com/themes/dreamtv/
echo.
echo ========================================================================
echo.

set /p confirma="Tem certeza que deseja fazer upload? (S/N): "

if /i not "%confirma%"=="S" (
    echo.
    echo [X] Upload cancelado.
    pause
    exit
)

echo.
echo [1/4] Criando backup no servidor...
echo Xc44v6k6v8@@ | ssh -o StrictHostKeyChecking=no root@209.14.84.36 "cp /var/www/html/themes/dreamtv/index.php /var/www/html/themes/dreamtv/index.php.backup_$(date +%%Y%%m%%d_%%H%%M%%S)"

echo.
echo [2/4] Enviando index.php...
echo Xc44v6k6v8@@ | scp -o StrictHostKeyChecking=no "C:\xampp\htdocs\webplayer_dev\themes\dreamtv\index.php" root@209.14.84.36:/var/www/html/themes/dreamtv/

echo.
echo [3/4] Ajustando permissoes...
echo Xc44v6k6v8@@ | ssh -o StrictHostKeyChecking=no root@209.14.84.36 "chmod 644 /var/www/html/themes/dreamtv/index.php"

echo.
echo [4/4] Verificando...
echo Xc44v6k6v8@@ | ssh -o StrictHostKeyChecking=no root@209.14.84.36 "ls -lh /var/www/html/themes/dreamtv/index.php"

echo.
echo ========================================================================
echo                   UPLOAD CONCLUIDO COM SUCESSO!
echo ========================================================================
echo.
echo Tema DreamTV atualizado em producao:
echo http://play.fivetv5.com/themes/dreamtv/
echo.
echo Pressione CTRL+F5 no navegador para ver as mudancas.
echo.
pause
