# SMS Package

## Installation Steps

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
php artisan vendor:publish --provider="Maxin\Sms\SMSServiceProvider" --tag="SMS"
```

## Before Start

* Remember to run the migration and seed.

* Fill provider keys inside **config/sms.php**.

* Import
```
use Maxin\Sms\SMSManager;
```

## Start 

#### Nexmo

* Sending SMS

```php
$message = SMSManager::provider('nexmo')
->withAPI('message')
->setParameters('13049080495', '您的验证码是1111')
->request()
->getMessageObject();
```

* Fetch balance infos

```php
$message = SMSManager::provider('nexmo')
->withAPI('balance')
->setParameters()
->request()
->getAccountObject();
```

#### Yunpian

* Sending SMS

```php
$messageObject = SMSManager::provider('yunpian')
->withAPI('message')
->setParameters('13049080495', '【X8国际】您的验证码是888877')
->request()
->getMessageObject();
```

* Fetch account infos

```php
$accountObject = SMSManager::provider('yunpian')
->withAPI('account')
->setParameters()
->request()
->getAccountObject();
```







