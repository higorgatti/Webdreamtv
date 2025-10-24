$password = ConvertTo-SecureString "Xc44v6k6v8@@" -AsPlainText -Force

Write-Host "Fazendo upload dos arquivos para VPS..."

# Upload header.php
Write-Host "1/3 Upload header.php..."
scp -o StrictHostKeyChecking=no C:\xampp\htdocs\webplayer\themes\protheme\includes\header.php root@209.14.84.36:/var/www/html/themes/protheme/includes/header.php

# Upload settings.php
Write-Host "2/3 Uploading settings.php..."
scp -o StrictHostKeyChecking=no C:\xampp\htdocs\webplayer\themes\protheme\settings.php root@209.14.84.36:/var/www/html/themes/protheme/settings.php

# Upload mediaPlayers-new.js (novo arquivo)
Write-Host "3/3 Uploading mediaPlayers-new.js..."
scp -o StrictHostKeyChecking=no C:\xampp\htdocs\webplayer\themes\protheme\jquery\mediaPlayers-new.js root@209.14.84.36:/var/www/html/themes/protheme/jquery/mediaPlayers-new.js

Write-Host "Upload concluído!"
