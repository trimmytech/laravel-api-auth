## Laravel API Authentication Using Passport

### Install Composer Packages 

```bash
composer install
```

### Set up `.env` file

```bash
cp .env.example .env
```

This will duplicate the contents of `.env.example` into `.env`. Edit `.env` with your preferred IDE or text editor and fill in your correct Database credentials.

### Generate application key

```bash
php artisan key:generate
```

### Run Migrations

```bash
php artisan migrate
```

### Install Passport 
php artisan make:model Profile -m
```bash
php artisan passport:install



### Serve

```bash
php artisan serve
```

URL :  http://127.0.0.1:8000







