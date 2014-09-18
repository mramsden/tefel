<?php namespace Tefel;

use Tefel\Feed\StationsFeed;

/**
 * Provides access to the TFL Open Data feeds.
 *
 * @author Marcus Ramsden <marcus.ramsden@gmail.com>
 * @since 0.1
 */
class Tefel {

    /**
     * @var string
     */
    protected $feedUrl;

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var string
     */
    protected $appKey;

    /**
     * Creates a new Tefel instance ready to supply data from the Open Data feeds.
     * @param  string $feedUrl The feed to download stations from
     * @param  string $appId   The app id to use to connect to the api
     * @param  string $appKey  The app key to use to connect to the api
     * @return Tefel           A new Tefel instance
     */
    public function __construct($feedUrl, $appId, $appKey)
    {
        $this->feedUrl = $feedUrl;
        $this->appId = $appId;
        $this->appKey = $appKey;
    }

    /**
     * Get all of the stations from the TFL Open Data feeds.
     *
     * @return Station[]
     */
    public function getStations()
    {
        return new StationsFeed($this->getStationsFeedUrl());
    }

    private function getStationsFeedUrl()
    {
        return $this->feedUrl . '?app_id=' . $this->appId . '&app_key=' . $this->appKey;
    }

}
