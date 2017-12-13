
# Logs - Laravel

[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require Dev4Born/logs
```

## Integration

In the `$providers` array add the `service providers` for this package.

```
Dev4Born\logs\LogsLaravelServiceProvider::class
```

Create config file `config/logs.php` and add the following lines.

```
return [
    ...
    'admin',
	'superuser',
];
```

You can specify permissions (middleware) for accessing logs.

## Usage

Go to http://{your-project}/laravel/logs 

## JSON API

Go to http://{your-project}/laravel/logs/json

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email: milosz.nowak@dev4born.pro instead of using the issue tracker.

## Credits

- [Dev4Born][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Screenshots

![Dashboard](https://dev4born.pro/pub/github/logs_screenshot.png)

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

[link-downloads]: https://packagist.org/packages/Dev4Born/logs
[link-author]: https://github.com/dev4born
[link-contributors]: ../../contributors
