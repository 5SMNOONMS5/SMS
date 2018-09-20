# SMS Package

## Installation

#### In composer.json

* Add below code into the **require** block

```json
"require": {
        "maxin/sms" : "dev-master"
    }
```

* Add below code into the **repositories** block

```json
 "repositories ": [
        {
            "name" : "maxin/sms",
            "type" : "git",
            "url"  : "git@gitlab.fcmvp.com:maxin/sms.git"
        }
    ],
```

#### In config/app.php

* Add SMSServiceProvider

```php
/*
 * Package Service Providers...
 */

Maxin\SMS\SMSServiceProvider::class,

```

#### In command line 

* Publish config asset from sms packages

```bash
php artisan vendor:publish
```

* Select Provider

```bash
Maxin\Sms\SMSServiceProvider
```

* It will copy those into given location inculdes **config**, **database needs** (seeder, migration, factory, faker) and **Models**.

## Start



