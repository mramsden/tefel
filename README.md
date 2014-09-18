tefel
=====

[![Build Status](https://travis-ci.org/mramsden/tefel.svg?branch=master)](https://travis-ci.org/mramsden/tefel)
[![Code Climate](https://codeclimate.com/github/mramsden/tefel/badges/gpa.svg)](https://codeclimate.com/github/mramsden/tefel)
[![Test Coverage](https://codeclimate.com/github/mramsden/tefel/badges/coverage.svg)](https://codeclimate.com/github/mramsden/tefel)

A PHP package for parsing Transport for London (TFL) data feeds, includes support for Laravel 4.

Currently there is only support for extracting station facilities data and line information.

More information about the TFL Open Data feeds can be found at
[https://www.tfl.gov.uk/info-for/open-data-users/](https://www.tfl.gov.uk/info-for/open-data-users/).

Usage
=====

Note that for this library function you will have needed to obtain access to the TFL open data
feeds and been given an app_id and app_key.

Plain ol' PHP
-------------

```php
$tefel = new Tefel($stationFacilitiesFeedUrl, $appId, $appKey);
/** @var $stations Tefel\Feed\Station[] */
$stations = $tefel->getStations();
```

Laravel 4
---------

To setup Tefel with Laravel 4 it's the usual setup process as with any package.

Add the following entries to your _app/config/app.php_;

```php
'providers' => array(
  // ...
  'Tefel\TefelServiceProvider',
),
```

A facade is available for use in Laravel 4.

```php
'aliases' => array(
  // ...
  'TFL' => 'Tefel\Facade\TefelFacade',
),
```

Usage is then more familiar for Laravel 4 users;

```php
/** @var $stations Tefel\Feed\Station[] */
$stations = Tefel::getStations();
```

Configuration is available for the package in Laravel 4. You can publish the
configuration to your application by running;

```
php artisan config:publish mramsden/tefel
```

The following configuration is available;

| name              | description                                           |
|-------------------|-------------------------------------------------------|
| stations_feed_url | The URL to download the station facilities feed from. |
| app_id            | The app id issued to you by TFL.                      |
| app_key           | The app key issued to you by TFL.                     |

Note that you don't need to change the `app_id` and `app_key` values in your own
configuration file. You can also assign these values through the `TFL_APP_ID` and
`TFL_APP_KEY` environment variables respectively.

License
=======

The MIT License

Copyright (c) 2014 Marcus Ramsden.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
