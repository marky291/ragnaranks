# Ragnaranks
[![Build Status](https://travis-ci.com/marky291/ragnaranks.svg?token=rSzsJZBSMZpGe42pERU9&branch=master)](https://travis-ci.com/marky291/ragnaranks)
[![Latest Version](https://img.shields.io/github/v/release/marky291/Ragnaranks.svg?style=flat-square)](https://github.com/marky291/ragnaranks/releases)

## Installation

[Git](https://git-scm.com/) pull this repository to a location of choice on your computer.
```
$ git clone https://github.com/marky291/ragnaranks.git
```

Download and use [Composer](https://getcomposer.org/), in the root of the project.

``` bash
$ composer install
```

Create a database and migrate database files using
```
$ php artisan migrate
```

Create test data using seeders to create fake models to test
```
$ php artisan db:seed
```

Serve the website to a local dev browser, by running the following command at the root of the project

``` bash
$ php artisan serve
```

## Testing

``` bash
$ phpunit
```

## Security

If you discover a security vulnerability within this package, send an email to marky360@live.ie

## Credits

This project exists thanks to all the people who [contribute](../../contributors).

## License

Mozilla Public License Version 2.0 ([MPL-2.0](./LICENSE)).
