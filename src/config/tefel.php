<?php
return [

    // This is the feed url for the station facilities feed
    'stations_feed_url' => 'http://data.tfl.gov.uk/tfl/syndication/feeds/stations-facilities.xml',

    // This is the app id supplied to you by TFL, sign up for an id at
    // https://api-portal.tfl.gov.uk.
    'app_id' => getenv('TFL_APP_ID'),

    // This is the app key supplied to you by TFL.
    'app_key' => getenv('TFL_APP_KEY'),

];
