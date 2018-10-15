# SMS Package

## Prerequisite

* Sign up [Nexmo](https://www.nexmo.com/) or [Yunpian](https://www.yunpian.com/) first

## Installation Steps

#### Require the Package

```
composer require tasb00429/sms
```

#### Add service provider

* In **config/app.php**

```php
/*
 * Package Service Providers...
 */

Tasb00429\Sms\SMSServiceProvider::class,

```

#### In command line 

* Publish config asset from sms packages.

```bash
php artisan vendor:publish --provider="Tasb00429\Sms\SMSServiceProvider" --tag="SMS"
```

#### Update config file 

* Place your key for each providers.

## Start 

#### Nexmo

###### sending SMS

```php
$message = SMSManager::provider('nexmo')
->withAPI('message')
->setParameters('Your number', '您的验证码是 1234')
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
->setParameters('Your number', '您的验证码是 1234')
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







