![logo](https://cdn.stanbridge.edu/global/img/logo--documentation.png)

---

# Visual Laravel Exceptions for SPAs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stanbridge/visual-exceptions.svg?style=flat-square)](https://packagist.org/packages/stanbridge/visual-exceptions)
![Tests](https://github.com/stanbridge/visual-exceptions/workflows/Tests/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/stanbridge/visual-exceptions.svg?style=flat-square)](https://packagist.org/packages/stanbridge/visual-exceptions)


This package provides single page applications with a visual representation of exceptions similar to traditional
Laravel applications. This is accomplished by temporarily storing the output of the rendered exception in a file. When
the client receives an error, you can use the included `render-exception.js` service to open up an iframe to display
the rendered exception in the browser.

## Installation

You can install the package via composer:

```bash
composer require stanbridge/visual-exceptions
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Stanbridge\VisualException\VisualExceptionServiceProvider" --tag="config"
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

### 1. Capture the Exception

In your `app/Exceptions/Handler.php`, capture the rendered exception with the following:

```php
use \Illuminate\Support\Facades\Config;
use Stanbridge\VisualException\VisualException;

public function render($request, Throwable $exception)
{
    $render = $this->prepareResponse($request, $exception);
    
    if (Config::get('visual-exceptions.enabled')) {
        VisualException::capture($render);
    }
    
    return $render;
}
```

### 2. Publish the assets:
`php artisan vendor:publish --provider="Stanbridge\VisualException\VisualExceptionServiceProvider" --tag=assets`

### 3. Display the Exception

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

The code in `render-exception.js` comes from <a href="https://github.com/livewire/livewire">Livewire</a>. Thanks to
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
