# laravel-push-db

![Software License][ico-license]

This package allows you to easily export your database. It also provides an [artisan](https://laravel.com/docs/5.5/artisan#generating-commands) command, `php artisan db:push` to make the process simpler. You can either run manually from the console or use with Laravel scheduler. It's totally a matter of choice.


## Requirements
[PHP](https://php.net) 5.4 or greater, [Composer](https://getcomposer.org) are required.

## Installation
Run `composer require therealsmat/laravel-push-db` to pull the latest version of the package

## Configuration
To start using laravel-push-db, add `therealsmat\PushDB\PushDBServiceProvider::class` to the providers array of your `app.php` file.

Next, publish the PushDB Service provider by running `php artisan vendor:publish --provider="therealsmat\PushDB\PushDBServiceProvider"`. 

You will get a config file named `pushdb.php`. Feel free to edit it if you wish.

Also out of the box, you will get a new artisan command `db:push`. This command alone will get your database exported quickly.

## Usage
There are two ways to use this package.

#### Controller
```php
public function export(PushDB $db)
    {
        try{
            if ($db->export()) {
                return 'Database Export Successful';
            }
            return 'Database export not successful';
        } catch (ProcessFailedException $e)
        {
            return $e->getMessage();
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }
```

#### Command
Simply run `php artisan db:push` and your database will be placed in the path you set from the `pushdb.php` `output_path` option.
As simple as this command is, it can be used in several ways. 

1. You can use programmatically in your controllers
```php
/**
* Call the artisan command
*/
Artisan::call('db:push');

/**
* Get the file from the output path
*/
Storage::disk('s3')->put('Database.sql', config('pushdb.output_path'));
```
Of course, you must have set up your s3 disk from the `filesystems.php` file.

2. You can schedule (1) above to run automatically using Laravel Scheduler e.g 

```php
$schedule->command('db:push --force')->daily();
```

## Supported Databases
Only mysql database is supported for now!

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
