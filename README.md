# Laravel users CLI
Create, manage and delete the standard `App\User` model throgh your terminal

## Installation

1. Run on your Laravel project
  ```bash
  composer require ecomputer/laravel-users-cli
  ```

2. In your `config/app.php` file, register `Ecomputer\LaravelUsersCLI\LaravelUsersCLIServiceProvider::class` as a new provider
  ```php
  'providers' => [
    // ...
    Ecomputer\LaravelUsersCLI\LaravelUsersCLIServiceProvider::class,
    // ...
  ]
  ```

3. Done!

## Example
![List command example](https://github.com/ecomputer/laravel-users-cli/blob/master/img/examples/list.png?raw=true)

### Available commands

#### Create
Create a basic Laravel user, step by step

```bash
php artisan ecomputer:users:create
```
#### Delete
Delete a user. If you run the command without parameters Artisan will give you a choice filled with all the registered users.
You can select an user with the arrow keys, with a numeric option, or autocompleting while writing the name of the user.
```bash
php artisan ecomputer:users:delete
```

If you know the ID of the user you want to delete, just pass it as a parameter.
```bash
php artisan ecomputer:users:delete --id=1
```

In all cases, the assistant will be gentle and will ask you for confirmation (defaults to no, for avoiding accidents).

#### List

Gives a complete list of all the registered users.

```bash
php artisan ecomputer:users:list
```
