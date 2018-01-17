# laravel-push-db

![Software License][ico-license]

This package allows you to easily export your database. It also provides an [artisan](https://laravel.com/docs/5.5/artisan#generating-commands) command, `php artisan db:push` to make the process simpler. You can either run manually from the console or use with Laravel scheduler. It's totally a matter of choice.


## Requirements
[PHP](https://php.net) 5.4 or greater, [Composer](https://getcomposer.org) are required.

## TODO
* Implement push to cloud storage feature e.g push to Dropbox, google drive e.t.c.
* Check that the config values are present before sending into the `process` method.
* Check to see that the database exists before exporting.
* Write comprehensive tests to make the package more reliable.
* Include support for other databases.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/therealsmat/laravel-ebulksms.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-yellow.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/therealsmat/laravel-ebulksmsr.svg?style=flat-square
