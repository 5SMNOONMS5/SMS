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

* It will copy File [/vendor/maxin/sms/config/sms.php] To [/config/sms.php]

## Start 

#### Nexmo

```php

use Maxin\Sms\SMSManager;

$sms = SMSManager::provider('nexmo')
        ->setPrerequisite()
        ->setQueryParameters('Your number', 'Text here')
        ->send()
        ->sms();
```

#### Yunpian

```php

use Maxin\Sms\SMSManager;
use Maxin\Sms\Providers\YunpianConfig;

$text = urlencode('#name#').'='.urlencode("asd").'&'.urlencode('#order#').'='.urlencode("123");

$sms = SMSManager::provider('yunpian')
->setPrerequisite(YunpianConfig::TEMPLATE[YunpianConfig::REQUIRE_PARAMETERS], 
                  YunpianConfig::TEMPLATE[YunpianConfig::ENDPOINT])
->setQueryParameters('13049080495', $text, [
    'tpl_id'    => '2478804',
    'tpl_value' => $text
])
->send()
->sms();
```







