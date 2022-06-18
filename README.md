# Installation
1. Run `git clone git@github.com:George1Meshveliani/Laralile.git`
2. Run `composer update`
3. Run `composer install`
4. Run `cp .env.example .env.`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `php artisan serve`
8. Go to link http://localhost:8000

To launch other services like e.g `phpmyadmin` run `./vendor/bin/sail up` or `docker-compose up`.

Before the installation make sure that other services like apache and mysql are stopped.
You can run `sudo service apache2 stop` and `sudo service mysql stop`.

#### Endpoints:

`POST`
- http://localhost:8000/api/user-signup
- http://localhost:8000/api/user-login

`GET` 
- http://localhost:8000/api/users
- http://localhost:8000/api/quotes
- http://localhost:8000/api/user/{user_email}

You can download and import environment and collection files into your postman and test them.
