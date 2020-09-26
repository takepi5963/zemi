@echo off
cd ../
cd web
cd laravelapp
php -S localhost:8000 -t public
cd /d　%~dp0