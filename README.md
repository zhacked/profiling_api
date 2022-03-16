# profiling_api
    profiling system for technical department


# Setup
    $ cp .env.example .env </br>
    $ composer install </br>
    $ php artisan key:generate </br>
    $ php artisan jwt:secret </br>
    $ php artisan migrate --seed </br>
    $ php artisan config:cache </br>
    $ php artisan route:cache </br>
       
# Run
    php artisan serve
  
