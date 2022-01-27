buat terlebih dahulu .ENV bisa di copy terlebih dahulu dari .env.example
kemudian konfigurasi .ENV APP_Key dan database, pastikan database di buat sebelum di migrasi


1. composer install
2. php artisan migrate
3. php artisan db:seed
4. php artisan serve
5. Test menggunakan postman atau sejenisnya


untuk tugas back-end dan logika ada di satu project, end point routingnya ada di routes\api.php

