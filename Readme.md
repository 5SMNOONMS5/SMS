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

* One thing that matter is this project I am using Method Chaining, plz see the following logic

```php

# 1 . [ Require ] Provider.

SMSManager::provider('nexmo')

# 2 . [ Require ] Api.

->withAPI('message')

# 3 . [ Option ] Ser account, default is the first account.

->setAccount('account1')

# 4 . [ Option ] Set parameters, it depends on the API.

->setParameters('13049080495', '您的验证码是1111')

# 5 . [ Require ] Reqeust.

->request()

# 6 . [ Require ] Get return object which will be either Message | Error.

->getMessageObject();

```

## Start 

#### Nexmo Example

* Sending SMS

```php
$message = SMSManager::provider('nexmo')
->withAPI('message')
->setAccount('account1')
->setParameters('13049080495', '您的验证码是1111')
->request()
->getMessageObject();
```

* Fetch balance infos

```php
$message = SMSManager::provider('nexmo')
->withAPI('balance')
->setAccount('account1')
->setParameters()
->request()
->getAccountObject();
```

#### Yunpian Example

* Sending SMS

```php
$messageObject = SMSManager::provider('yunpian')
->withAPI('message')
->setAccount('account1')
->setParameters('13049080495', '【X8国际】您的验证码是888877')
->request()
->getMessageObject();
```

* Fetch account infos

```php
$accountObject = SMSManager::provider('yunpian')
->withAPI('account')
->setAccount('account1')
->setParameters()
->request()
->getAccountObject();
```







