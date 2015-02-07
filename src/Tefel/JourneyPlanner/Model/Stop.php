<?php namespace Tefel\JourneyPlanner\Model;

class Stop
{

	/**
	 * @var string
	 */
	private $atcoCode;
	
	/**
	 * @var string
	 */
	private $name;
	
	/**
	 * @var float
	 */
	private $longitude;
	
	/**
	 * @var float
	 */
	private $latitude;

	public function __construct($atcoCode, $name, $longitude, $latitude)
	{
		$this->atcoCode = $atcoCode;
		$this->name = $name;
		$this->longitude = $longitude;
		$this->latitude = $latitude;
	}

    public function getAtcoCode()
    {
        return $this->atcoCode;
    }

    public function setAtcoCode($atcoCode)
    {
        $this->atcoCode = $atcoCode;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }
    
}