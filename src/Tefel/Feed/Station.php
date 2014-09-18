<?php namespace Tefel\Feed;

use SimpleXMLElement;
use stdClass;

class Station {

    /**
     * @var SimpleXMLElement
     */
    private $stationElement;

    /**
     * @var string
     */
    private $name;

    /**
     * @var stdClass
     */
    private $location;

    /**
     * @var string[]
     */
    private $lines;

    public function __construct(SimpleXMLElement $stationElement)
    {
        $this->stationElement = $stationElement;
    }


    public function getName()
    {
        if (is_null($this->name)) {
            $this->name = (string) $this->stationElement->name;
        }

        return $this->name;
    }

    public function getLocation()
    {
        if (is_null($this->location)) {
            $coordinates = (string) $this->stationElement->Placemark->Point->coordinates;
            list($longitude, $latitude, $altitude) = explode(",", $coordinates);

            $this->location = new stdClass;
            $this->location->longitude = (int) (round($longitude * 1000000));
            $this->location->latitude = (int) (round($latitude * 1000000));
        }

        return $this->location;
    }

    public function getLines()
    {
        if (is_null($this->lines)) {
            $this->lines = array_map(function($servingLine)
            {
                return $servingLine;
            }, (array) $this->stationElement->xpath('//servingLines/servingLine'));

            if (empty($this->lines)) {
                $this->lines = array_map(function($trainName)
                {
                    return trim($trainName);
                }, (array) $this->stationElement->xpath('//platformToTrain/trainName'));
                $this->lines = array_unique($this->lines);
            }
        }

        return $this->lines;
    }
}
