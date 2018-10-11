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

* Select **Provider** or **SMS** tag

```bash
Maxin\Sms\SMSServiceProvider
```

* It will copy some files from packages to your project

```bash
Copied Directory [/vendor/maxin/sms/database/seeds] To [/database/seeds]
Copied Directory [/vendor/maxin/sms/database/migrations] To [/database/migrations]
Copied Directory [/vendor/maxin/sms/database/factory] To [/database/factories]
Copied Directory [/vendor/maxin/sms/database/faker] To [/app]
Copied Directory [/vendor/maxin/sms/models] To [/app/Http]
```

## Before Start

* Remember to run the migration and seed.

* Offer provider keys inside config/sms.php.

* Import
```
use Maxin\Sms\SMSManager;
```

## Start 

#### Nexmo

###### sending SMS

```php
$message = SMSManager::provider('nexmo')
->withAPI('message')
->setParameters('13049080495', '您的验证码是1111')
->request()
->getMessageObject();
```

###### Fetch Account infos

```php
$message = SMSManager::provider('nexmo')
->withAPI('balance')
->setParameters()
->request()
->getAccountObject();
```

#### Yunpian

###### sending SMS

```php
$messageObject = SMSManager::provider('yunpian')
->withAPI('message')
->setParameters('13049080495', '【X8国际】您的验证码是888877')
->request()
->getMessageObject();
```

###### Fetch Account infos

```php
$accountObject = SMSManager::provider('yunpian')
->withAPI('account')
->setParameters()
->request()
->getAccountObject();
```







