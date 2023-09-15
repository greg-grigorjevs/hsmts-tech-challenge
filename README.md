## Housemates Tech Challenge

## Requirements
* php@8.2
* composer@2.5.5

## Setup

### Install all the dependencies

```shell
composer install
yarn install
```

### Env setup

```shell
cp .env.example .env
```

### Run migrations

```shell
php artisan migrate --seed
```
Accept creating a database.sqlite file or add it manually by ```touch database/database.sqlite```

## Usage

In order to try the app in the browser run the following commands(in sepate terminals):

```shell
php artisan serve
```

```shell
yarn dev
```
OR
```shell
npm run dev
```

Go to `http://localhost:{port_that_php_is_running_on}/property` as an entry point 
from where you can do all the CRUD stuff with Properties and Rooms


## Tests

All test related to the challenge are located in `tests/Feature/PropertyControllerTest.php` and `tests/Feature/RoomControllerTest.php`
In order to run them use:

```shell
php artisan test
```
