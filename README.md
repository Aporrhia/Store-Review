# Requirments
- [PHP](https://www.php.net/downloads.php)
- [Node.js](https://nodejs.org/en/download) Download LTS (^ v22)
- [Composer](https://getcomposer.org/)
- [MySQL](https://dev.mysql.com/downloads/installer/)
- In *php* folder open *php.ini* and find this extension and uncomment it (remove ";"): `extension=zip`, `extension=intl`, `extension=fileinfo`, `extension=pdo_mysql`

# Project Initialisation
Run following commands:
1. `npm update`
2. `npm run build`
3. `composer global require laravel/installer`
4. `composer update`
5. Make a copy of ".env.example" and rename it to ".env"
6. `php artisan key:generate`
7. `php artisan migrate` (Create DB and migrate files)
8. `php artisan serve` To run locally
9. `php artisan make:filament-user`

![Login Page](/assets/git_images/login.png)