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

```bash
Copied File [/packages/maxin/sms/config/sms.php] To [/config/sms.php]
Copied Directory [/packages/maxin/sms/database/seeds] To [/database/seeds]
Copied Directory [/packages/maxin/sms/database/migrations] To [/database/migrations]
Copied Directory [/packages/maxin/sms/database/faker] To [/app]
Copied Directory [/packages/maxin/sms/database/factory] To [/database/factories]
Copied Directory [/packages/maxin/sms/src/Models] To [/app/Http]
```

## Start



