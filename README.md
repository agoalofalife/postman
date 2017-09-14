## Commands

```
php artisan migrate
php artisan vendor:publish --tag=postman-migration   
php artisan postman:seed 
php artisan postman:install 

 if (config('posman.switcher')) {
    $schedule->command(ParseCommand::class)->everyMinute();
  }
```
