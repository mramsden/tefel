tefel
=====

A PHP package for parsing Transport for London (TFL) data feeds, includes support for Laravel 4.

Currently there is only support for extracting station facilities data and line information.

More information about the TFL Open Data feeds can be found at 
[https://www.tfl.gov.uk/info-for/open-data-users/](https://www.tfl.gov.uk/info-for/open-data-users/).

Usage
=====

Note that for this library function you will have needed to obtain access to the TFL open data
feeds and been given an app_id and app_key.

```php
$tefel = new Tefel($stationFacilitiesFeedUrl, $appId, $appKey);
/** @var $stations Station[] */
$stations = $tefel->getStations();
```

License
=======

The MIT License

Copyright (c) 2014 Marcus Ramsden

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
