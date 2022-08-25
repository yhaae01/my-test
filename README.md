<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Spesifikasi Minimal:
- PHP > 7.4

## Cara Penggunaan

1. Jalankan perintah 
```bash
composer install
```

2. Copy file .env dari .env.example
```bash
cp .env.example .env
```
3. Setting nama database sesuai dengan keinginan.

4. Lakukan perintah
```bash
php artisan key:generate
```
5. Migrate database
```bash
php artisan migrate
```
6. Jalankan Storage link
```bash
php artisan storage:link
```