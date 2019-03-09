# Vegan Playlist

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1100 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost you and your team's skills by digging into our comprehensive video library.

## Set Up

### Linux/Ubuntu

Step 1. Clone the repository.

Step 2. Install php and required extensions:

```console
$ sudo apt-get install php7.2-dom php7.2-zip php7.2-mbstring php7.2-zip
```

Step 3: Install composer:

Follow the instructions at [getcomposer.org](https://getcomposer.org/download/).

Step 4. Install local dependencies:

```console
$ php composer.phar install
```

Step 5. Configure laravel:

```console
$ cp .env.example .env
$ # make any necessary changes to .env, e.g. database info
$ php artisan key:generate
```

Step 6. Small fix to run the development server (in `server.php`)

```php
// replace the final line with this
require_once __DIR__.'/public/index.php';
```

Note: do not commit this change! The current code is required as a hack for the hosting situation.

Step 7. Run the development server:

```console
$ php artisan serve
Laravel development server started: <http://127.0.0.1:8000>
```

Navigate to [localhost](http://127.0.0.1:8000) and get started!

Note: you may also configure the local site to run using Apache or nginx.

## License

All rights reserved.
