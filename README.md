# Phpdantic

Data validation using PHP type hints.

# Installation

## Composer

Inside your project enter the following;
```
composer require kekke88/phpdantic
```

# Introduction
Have you ever seen code such as;
```
...
$json = $client->request('GET', '/user/1');
$user = json_decode($json);

if(!isset($user->name) || !is_string($user->name)) {
    die("Name does not exist");
}
...
```
Where you'd have to go the API docs back and forth and guess what the user object contains?
This library intends to solve this the easy way, by using validation against a data model and assigning values to the model so that you can use your IDE´s features for your objects.

# Example
```
<?php

declare(strict_types=1);

namespace Kekke\Catfact;

require_once('vendor/autoload.php');

use Kekke88\Phpdantic\BaseModel;
use GuzzleHttp\Client;
use Kekke88\Phpdantic\Exceptions\PhpdanticException;

class Catfact extends BaseModel
{
    public string $fact;
    public int $length;
}

$client = new Client([
    'base_uri' => 'https://catfact.ninja/',
    'timeout'  => 2.0,
]);

$response = $client->request('GET', 'fact');

try {
    $fact = new Catfact(json_decode((string) $response->getBody(), true));
} catch (PhpdanticException $e) {
    echo $e->getMessage();
}

var_dump($fact);

```

# Validator example
```
<?php

declare(strict_types=1);

namespace Kekke\Catfact;

require_once('vendor/autoload.php');

use Kekke88\Phpdantic\BaseModel;
use GuzzleHttp\Client;
use Kekke88\Phpdantic\Exceptions\PhpdanticException;

class Catfact extends BaseModel
{
    public string $fact;
    public int $length;

    public array $phpdanticValidators = [
        'length' => 'validateLength',
    ];

    public function validateLength(int $length): bool
    {
        if($length < 60) {
            return false;
        }

        return true;
    }
}

$client = new Client([
    'base_uri' => 'https://catfact.ninja/',
    'timeout'  => 2.0,
]);

$response = $client->request('GET', 'fact');

try {
    $fact = new Catfact(json_decode((string) $response->getBody(), true));
} catch (PhpdanticException $e) {
    echo $e->getMessage(); // Validation method validateLength failed at property length
}
```

# Work in progress
* Collections
* Functions to validate against objects and/or json directly

# Contributing

Contributions are welcome, open a PR if you want to contribute.

# Issues

Please open an issue if you find something that does not work as expected
