# Visual Laravel Exceptions for SPAs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/austinw/visual-exceptions.svg?style=flat-square)](https://packagist.org/packages/austinw/visual-exceptions)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/austinw/visual-exceptions/run-tests?label=tests)](https://github.com/austinw/visual-exceptions/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/austinw/visual-exceptions.svg?style=flat-square)](https://packagist.org/packages/austinw/visual-exceptions)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support me


## Installation

You can install the package via composer:

```bash
composer require austinw/visual-exceptions
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Austinw\VisualException\VisualExceptionServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Visual Exceptions Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where visual exceptions will be accessible from.
    |
    */

    'path' => env('VISUAL_EXCEPTIONS_PATH', 'api/visual-exceptions'),

    'storage' => 'visual-exceptions/latest.html',

    'clear_on_retrieve' => env('VISUAL_EXCEPTIONS_CLEAR', true),

    'middleware' => ['api'],

    /*
    |--------------------------------------------------------------------------
    | Visual Exceptions Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to completely disable visual exceptions.
    |
    */

    'enabled' => env('VISUAL_EXCEPTIONS_ENABLED', true),
];
```

## Usage


## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email austingym@gmail.com instead of using the issue tracker.

## Credits

- [Austin White](https://github.com/AustinW)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
