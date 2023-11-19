# Phpdantic

Data validation using PHP type hints.

# Installation

## Composer

Inside your project enter the following;
```
composer require kekke88/phpdantic
```

# Example
```
<?php

declare(strict_types=1);

use Kekke88\Phpdantic\BaseModel;

class User extends BaseModel
{
    public int $id;
    public string $name = 'Kevin Mitnick';
    public ?string $signupDate;
}

$data = [
    'id' => 1,
    'signupDate' => '2023-11-19',
];

$user = new User($data);
echo $user->id; // equals to 1
echo $user->name; //equals to Kevin Mitnick
```

# Contributing

Contributions are welcome, open a PR if you want to contribute.

# Issues

Please open an issue if you find something that does not work as expected