# SMS Package

## Installation

#### In composer.json

* Add in the **require** block

```
"require": {
        .
        .
        .
        .
        "maxin/sms" : "dev-master"
    }
```

* Add in the **repositories** block

```
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

```
/*
 * Package Service Providers...
 */
.
.
Maxin\SMS\SMSServiceProvider::class,
.
.

/*
 * Application Service Providers...
 */

```

#### In command line 

* Publish config asset from sms packages

```bash 
php artisan vendor:publish
```

* Select Provider
```
Maxin\Sms\SMSServiceProvider
```

* It will copy File [/vendor/maxin/sms/config/sms.php] To [/config/sms.php]

## Start



