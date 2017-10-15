
<h1 align="center">POSTMAN</h1>

<p align="center"><img src="https://github.com/agoalofalife/postman/blob/master/preview.jpg"></p>


<p align="center">
 <a href="https://scrutinizer-ci.com/g/agoalofalife/postman/?branch=master"><img src="https://scrutinizer-ci.com/g/agoalofalife/postman/badges/quality-score.png?b=master"></a>
  <a href="https://scrutinizer-ci.com/g/agoalofalife/postman/?branch=master"><img src="https://scrutinizer-ci.com/g/agoalofalife/postman/badges/coverage.png?b=master"></a>
 <a href="https://scrutinizer-ci.com/g/agoalofalife/postman/?branch=master"><img src="https://scrutinizer-ci.com/g/agoalofalife/postman/badges/build.png?b=master"></a>
 </p>

> **Note** Required PHP version >= 7.1 

**What is it?** 

This package is for [Laravel](laravel.com). Using the interface you can send the emails on schedule.

It's simple! You are creating a letter and sending it at just the right time!

You intrigued?

Read on!

## Install
Installed via [composer](https://getcomposer.org/).

```bash
composer require agoalofalife/postman

```
Before you install the package, it is important to define your language.

In file config/app.php

```php

 'locale' => 'en',
```
> **Note** Out of the box `en` and `ru`.

Next, you're executing the command:

```bash
php artisan postman:install
```
Now you can insert the template where you want. 

It could be your administrative panel or what else.

```php
...
  <body>
    @include('postman::app')
    ...
```

now you can see your interface!

![postman](https://github.com/agoalofalife/postman/blob/master/start-page.jpg)

And last.. You need to work **cron**.
`App\Console\Kernel`

```php
 if (config('postman.switcher')) {
            $schedule->command(ParseCommand::class)->everyMinute();
        }
        
```

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
