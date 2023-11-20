## Installation Guide
- Clone this repo.
- Run `composer install`.
- clone this repo

```
    composer install
    npm install
```

- create a new file `.env` and then copy all contents of the file `.env.example`
- set the project key

```
    php artisan key:generate
```

- create databse

```
    shopping_cart_db
```

- Migration

```
    php artisan migrate
```

- Test Data Setup

```
    php artisan db:seed
```

- run project

```
    php artisan serve
    npm run dev
```
