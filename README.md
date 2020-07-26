# Visual Laravel Exceptions for SPAs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/austinw/visual-exceptions.svg?style=flat-square)](https://packagist.org/packages/austinw/visual-exceptions)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/austinw/visual-exceptions/run-tests?label=tests)](https://github.com/austinw/visual-exceptions/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/austinw/visual-exceptions.svg?style=flat-square)](https://packagist.org/packages/austinw/visual-exceptions)


This package provides single page applications with a visual representation of exceptions similar to traditional
Laravel applications. This is accomplished by temporarily storing the output of the rendered exception in a file. When
the client receives an error, you can use the included `render-exception.js` service to open up an iframe to display
the rendered exception in the browser.


## Support me
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4H6K7XTMR79VA&source=url"><img src="paypal.svg" height="48" alt="Donate" /></a>

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
    | Master Switch
    |--------------------------------------------------------------------------
    |
    | This option may be used to completely disable visual exceptions.
    |
    */

    'enabled' => env('VISUAL_EXCEPTIONS_ENABLED', env('APP_DEBUG')),

    /*
    |--------------------------------------------------------------------------
    | Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where visual exceptions will be accessible from.
    |
    */

    'path' => env('VISUAL_EXCEPTIONS_PATH', 'api/visual-exceptions'),

    /*
    |--------------------------------------------------------------------------
    | Storage
    |--------------------------------------------------------------------------
    |
    | This is where the temporary exception output will be stored.
    |
    */

    'storage' => 'visual-exceptions/latest.html',

    /*
    |--------------------------------------------------------------------------
    | Clear on Retrieve
    |--------------------------------------------------------------------------
    |
    | Use this option to clear the exception file after retrieving it.
    |
    */

    'clear_on_retrieve' => env('VISUAL_EXCEPTIONS_CLEAR', true),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Set middleware on the route.
    |
    */

    'middleware' => ['api'],
];
```

## Usage

1. Capture the Exception

In your `app/Exceptions/Handler.php`, capture the rendered exception with the following:

```php
use \Illuminate\Support\Facades\Config;
use Austinw\VisualException\VisualException;

if (Config::get('visual-exceptions.enabled')) {
    VisualException::capture($this->prepareResponse($request, $exception));
}
```

2. Display the Exception

Publish the assets:
`...`

Copy the `render-exception.js` file from the published assets into your single page application.

Import the library and use the `retrieveLastError()` method. Here is an example using an axios interceptor:
```js
import axios from 'axios';
import VisualException from 'path/to/render-exception.js';

axios.interceptors.response.use(response => response, error => {
    if (error.response.status >= 500) {
        VisualException.retrieveLastError();
    }
});
```

The code in render-exception comes from <a href="https://github.com/livewire/livewire">Livewire</a>. Thanks to
<a href="https://github.com/calebporzio">Caleb Porzio</a> and <a href="https://github.com/reinink">Jonathan Reinink</a>

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
