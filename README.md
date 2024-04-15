
# Human Resource Information System using Laravel Filament

Make sure you have the latest versions of Nodejs ^18, PHP ^8.2, Composer, & DBMS such as PHPmyadmin installed in your device.

You can download/use Laravel Herd https://herd.laravel.com/windows to easily install Node.js, PHP, & Composer but Mysql isn't part of the free package.

Alternatively, you can download/use Laragon https://laragon.org/download/index.html but you still have to download Composer https://getcomposer.org/Composer-Setup.exe separately and update the included PHP & Node.js to the latest version, 

## Installation

To get started, follow these steps:

1. Clone the repository:
   ```bash
   git clone https://github.com/mark-villanueva/HRIS_PUPSMB.git
   ```

2. Navigate to the cloned directory:
   ```bash
   cd HRIS_PUPSMB
   ```

3. Install Composer dependencies:
   ```bash
   composer install
   ```

4. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

5. Generate an application key:
   ```bash
   php artisan key:generate
   ```

6. Migrate the database:
   ```bash
   php artisan migrate
   ```

7. Generate Permissions and/or Policies for Filament entities
   ```bash
   php artisan shield:generate --all
   ```

8. Seed the Database:
   ```bash
   php artisan db:seed
   ```
   
9. Set the seeded credential as super_admin:
   ```bash
   php artisan shield:super-admin
   ```

10. Serve the application:
   ```bash
   php artisan serve
    ```
   
11. Open /admin in your web browser, sign in using these credentials:
    Email: test@example.com
    Password: password

## Additional: Use this if the app is slow 
 ```bash
php artisan icons:cache
```


This project is part of our OJT task 

