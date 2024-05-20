# php-sdk

Official PHP SDK for [ma-residence](https://www.ma-residence.fr)'s API.

## Get started

To use [ma-residence's API](https://github.com/ensembl260/api), you have to register your application.
When registering your application, you will obtain a ***client_id*** and ***client_secret***.
The ***client_id*** and ***client_secret*** will be necessary to use the API.

## Installation

Edit your `composer.json` :

```json
{
    "require": {
        "ma-residence/php-sdk": "2.0.*"
    },
    "repositories": [
        {
            "type": "vcs",
            "url":  "https://github.comma-residence/php-sdk.git",
            "no-api": true
        }
    ]
}
```

## Composer Update

docker run -it --name docker-php-sdk --rm -v "$PWD/php-sdk:/user/src/php-sdk" -w /user/src/php-sdk composer composer update

## Usage

```php
<?php

use MR\SDK\Client;

$host = 'https://api.ensembl.fr/';
$clientId = 'CLIENT_ID';
$clientSecret = 'CLIENT_SECRET';

$mrClient = new Client($host, $clientId, $clientSecret);
```

By default, the `Client` will store the tokens in memory.
If you need to implement a custom token storage, you can use the `TokenStorageInterface` and assigned it to the `Client`.

```php
<?php

$storage = new MyTokenStorage();
$mrClient = new Client($host, $clientId, $clientSecret, $storage);
```

After you have initialized the class, you can login with an email and password:

```php
$mrClient->auth()->loginWithCredentials('developpeur@ma-residence.fr', 'password');
```

Or with an external token:

```php
$mrClient->auth()->loginWithExternalToken('facebook', 'FACEBOOK_ACCESS_TOKEN');
```

And if to logout:

```php
$mrClient->auth()->logout();
```

## Endpoints

```php
$mrClient->myEndpoint()->foo();
```

Available endpoints:

- Me
- User
- Groups
- Associations
- CityHalls
- Categories

## Request

If you have to call an url which has no endpoint, you can still do your own request:

```php
// GET Request
$mrClient->request()->get('/foo', [ 'id' => $id ]);

// POST Request
$mrClient->request()->post('/foo', [], [
    'field_a' => 'A',
    'field_b' => 'B',
]);

// PUT Request
$mrClient->request()->put('/foo', [], [
    'field_a' => 'AA',
    'field_b' => 'BB',
]);

// PATCH Request
$mrClient->request()->patch('/foo', [], [
    'field_b' => 'C',
]);

// DELETE Request
$mrClient->request()->delete('/foo');
```

Each request returns a `Response` object.
