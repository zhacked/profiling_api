# profiling_api
    profiling system for technical department


# Setup
    $ cp .env.example .env
    $ composer install 
    $ php artisan key:generate 
    $ php artisan jwt:secret
    $ php artisan migrate --seed
    $ php artisan config:cache 
    $ php artisan route:cache 
       
# Run
    php artisan serve
  
