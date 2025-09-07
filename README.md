# Requirments
- [PHP](https://www.php.net/downloads.php)
- [Node.js](https://nodejs.org/en/download) Download LTS (^ v22)
- [Composer](https://getcomposer.org/)
- [MySQL](https://dev.mysql.com/downloads/installer/)
- In *php* folder open *php.ini* and find this extension and uncomment it (remove ";"): `extension=zip`

# Project Initialisation
Run following commands:
1. `npm update`
2. `npm run build`
3. `composer update`
4. Make a copy of ".env.example" and rename it to ".env"
5. `php artisan key:generate`
6. `php artisan migrate` (Create DB and migrate files)
7. `php artisan serve` To run locally

![Login Page](/assets/git_images/login.png)