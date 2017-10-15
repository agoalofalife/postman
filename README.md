# POSTMAN

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/agoalofalife/postman/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/postman/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/agoalofalife/postman/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/postman/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/agoalofalife/postman/badges/build.png?b=master)](https://scrutinizer-ci.com/g/agoalofalife/postman/build-status/master)

> **Note** Required PHP version >= 7.1 

**What is it?** 

This package is for [Laravel](laravel.com). Using the interface you can send the emails on schedule.

It's simple! You are creating a letter and sending it at just the right time!

You intrigued?

Read on!



## Commands

```
php artisan migrate
php artisan vendor:publish --tag=postman-migration   
php artisan postman:seed 
php artisan postman:install 

php artisan vendor:publish --tag=postman-components

 if (config('posman.switcher')) {
    $schedule->command(ParseCommand::class)->everyMinute();
  }
  
  locale in config.php (seed)
```

## Blade


```

    @include('postman::app')

```
