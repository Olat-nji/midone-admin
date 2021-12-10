# Midone Admin

- [Documentation](#introduction)
- [Usage](#usage)
- [Support](#support)

    
<a name="introduction"></a>
## What is it?

A Midone powered, laravel built admin dashboard, fully customized with an auth capabilities



<a name="usage"></a>
## Installation

Run:

```php
composer require olat-nji/midone-admin
```

Then:


```php
php artisan midone-admin:install
```

Then run migrations:

```php
php artisan migrate:fresh --seed
```
You also need to configure your app url to point to your application directory provided the application in local:
.env
```php
APP_URL=http://localhost/your-app/public
```
And your asset url has to point to the application directory to allow required assets in public folder to be seen:

```php
ASSET_URL=http://localhost/your-app/public
```


Now Enjoy:
## Support

This version supports Laravel 7 or greater.
* In case of any issues, kindly create an Issue.
* If you would like to contribute:
  * Fork this repository.
  * Implement your features.
  * Generate pull request.
 