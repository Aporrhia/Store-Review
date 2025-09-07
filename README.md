# Requirments
- [PHP](https://www.php.net/downloads.php)
- [Node.js](https://nodejs.org/en/download) Download LTS (^ v22)
- [Composer](https://getcomposer.org/)
- In *php* folder open *php.ini* and find this extension and uncomment it (remove ";"): `extension=zip`

# Project Initialisation
Run following commands:
1. `npm update`
2. `npm run build`
3. `composer update`
4. `php artisan migrate` (Create DB and migrate files)
5. Make a copy of *.env.example* and rename it to *.env*
6. `php artisan serve` To run locally

You must see this:
![Login Screen](/assets/git_images/login.png)