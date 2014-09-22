<?php namespace Tefel\Feed;

use ArrayAccess;
use Countable;
use Guzzle\Http\Client;
use IteratorAggregate;
use SimpleXMLElement;

class StationsFeed implements ArrayAccess, Countable, IteratorAggregate {

    /**
     * @var string
     */
    private $stationsFeedUrl;

    /**
     * @var SimpleXMLElement
     */
    private $feed;

    /**
     * @var Station[]
     */
    private $stations;

    /**
     * @var Guzzle\Http\Client
     */
    private $client;

    public function __construct($stationsFeedUrl)
    {
        $this->stationsFeedUrl = $stationsFeedUrl;
    }

    public function offsetExists($offset)
    {
        $stations = $this->getStations();
        return $stations[$offset];
    }

    public function offsetGet($offset)
    {
        $stations = $this->getStations();
        return $stations[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw new \Exception("This StationsFeed is immutable");
    }

    public function offsetUnset($offset)
    {
        throw new \Exception("This StationsFeed is immutable");
    }

    public function count()
    {
        return count($this->getStations());
    }

    public function getIterator()
    {
        foreach ($this->getStations as $key => $value) {
            yield $key => $value;
        }
    }

    /**
     * Gets the current instance of the Guzzle client to use for making a web
     * request.
     *
     * @return Client An Guzzle HTTP client ready for use
     */
    protected function getClient()
    {
        if ($this->client == null) {
            $this->client = new Client();
        }

        return $this->client;
    }

    protected function getFeed()
    {
        if ($this->feed == null) {
            $client = $this->getClient();
            $this->feed = new SimpleXMLElement(
                $client->get($this->stationsFeedUrl)->send()->getBody(true));
        }

        return $this->feed;
    }

    protected function getStations()
    {
        if ($this->stations == null) {
            $this->stations = array_map(function($stationElement)
            {
                return new Station(new SimpleXMLElement($stationElement->asXml()));
            }, $this->getFeed()->xpath('//station'));
        }

        return $this->stations;
    }

    /**
     * Allows a Guzzle HTTP client to be injected.
     *
     * @param Client $client The Guzzle HTTP client to use for the next request.
     *
     * @see getClient
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

}
