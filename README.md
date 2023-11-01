# Twill Redirects

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cwsdigital/twill-redirects.svg?style=flat-square)](https://packagist.org/packages/cwsdigital/twill-redirects)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/cwsdigital/twill-redirects.svg?style=flat-square)](https://packagist.org/packages/cwsdigital/twill-redirects)

![Add new redirect module preview](https://github.com/cwsdigital/twill-redirects/blob/main/Twill-Redirects-Preview.png)

## What it does
This package provides a simple way to allow users to manage any Redirects for their Twill Sites.

## Requirements
This package requires Laravel 8 or higher, PHP8 or higher, and Twill 3.0 or higher.

## Installation

First you want to install this dependency using composer, you can do this by running the following command:

```shell script
$ composer require cwsdigital/twill-redirects
```

```shell script
$ php artisan migrate
```

## Configuration

### Adding to your Twill Admin

This package is set up to automatically register the Redirects Capsule and add it directly to the Twill Admin Navigation.

#### Twill Admin Menu

You may want to determine where to place the `Redirects` module in your Twill Navigation, for example, you want Redirects to appear
as a secondary menu item within a primary navigation of Settings.

First you will need to publish the config file:

```shell script
  php artisan vendor:publish --provider="CwsDigital\TwillRedirects\TwillRedirectsServiceProvider" --tag=config
```
Secondly, change the 'automaticNavigation' to false. This will prevent Twill from automatically adding the Redirects Primary Navigation link.

```php

TwillNavigation::addLink(
    NavigationLink::make()->title('Settings')
        ->forModule('redirects')
    ->doNotAddSelfAsFirstChild()
    ->setChildren([
        NavigationLink::make()->title('Redirects')->forModule('redirects'),
    ])
);
```

## Adding to your frontend Middleware
To make your frontend routing aware of the Redirect middleware you need to add this to the laravel middleware in Kernel.php

```php
{{-- app/Http/Kernel.php --}}

protected $middleware = [
    // Add HandlesPageRedirects::class
    CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Http\Middleware\HandlesPageRedirects::class,
];
```

## Events

There are two events triggered in the Redirect Middleware.

1. **RedirectWasFound** event is triggered when a redirect has been found.
2. **RedirectWasNotFound** event is triggered when no redirect was found.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.