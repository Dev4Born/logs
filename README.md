
# Logs - Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require dev4born/logs
```

## Integration

In the `$providers` array add the `service providers` for this package.

```
Dev4Born\logs\LogsLaravelServiceProvider::class
```

Create config file `config/logs.php` and add the following lines.

```
/**
 *   
 *  Warning! You can only grant one permissions from 2 available
 *  
 *  @package dev4born\logs
 *  
 */
 
return [

    'settings' => [
	
    /**
	 *  
	 *  Secret key - unique address for accessing logs
	 *  
	 *  http://{your-project}/laravel/{secret-key}/logs
	 *  
	 */
	
        'secret' => '',

    /**
	 *  
	 *  Allowed permissions (middleware) for accessing logs
	 *  
	 *  http://{your-project}/laravel/view/logs
	 *  
	 */   
		
        'middleware' => [
            
		],
		
	],
	
];
```

You can specify 2 permissions (secret key or middleware) for accessing logs.

## Usage

Secret key

http://{your-project}/laravel/{your-secret-key}/logs 

Middleware

http://{your-project}/laravel/view/logs 

## JSON API

Secret key

http://{your-project}/laravel/{your-secret-key}/logs/json

Middleware

http://{your-project}/laravel/view/logs/json

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

[ico-version]: https://img.shields.io/packagist/v/dev4born/logs.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/dev4born/logs.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/dev4born/logs
[link-downloads]: https://packagist.org/packages/dev4born/logs
[link-author]: https://github.com/dev4born
[link-contributors]: ../../contributors
