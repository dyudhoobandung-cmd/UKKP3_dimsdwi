@echo off
title UKKP3_dimsdwi - Control Panel
:menu
cls
echo ===================================================
echo     UKKP3_dimsdwi - LARAVEL & GIT CONTROL PANEL
echo ===================================================
echo [1] Jalankan Server Laravel (php artisan serve)
echo [2] Run Migration & Seed (php artisan migrate:fresh --seed)
echo [3] Compile Assets Frontend (npm run dev)
echo [4] Cek Git Status
echo [5] Git Quick Commit & Push (main)
echo [6] Keluar
echo ===================================================
set /p opt="Pilih menu [1-6]: "

if "%opt%"=="1" goto serve
if "%opt%"=="2" goto migrate
if "%opt%"=="3" goto frontend
if "%opt%"=="4" goto status
if "%opt%"=="5" goto push
if "%opt%"=="6" exit

echo Pilihan tidak valid!
pause
goto menu

:serve
cls
echo Menjalankan Laravel Server...
php artisan serve
pause
goto menu

:migrate
cls
echo Menjalankan Migration & Seeder...
php artisan migrate:fresh --seed
pause
goto menu

:frontend
cls
echo Menjalankan Vite / NPM Dev...
npm run dev
pause
goto menu

:status
cls
echo Cek Status Git...
git status
pause
goto menu

:push
cls
echo Melakukan Commit dan Push ke GitHub...
set /p msg="Masukkan pesan commit: "
git add .
git commit -m "%msg%"
git push origin main
echo Push selesai!
pause
goto menu