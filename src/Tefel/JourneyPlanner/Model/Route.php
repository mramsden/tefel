<?php namespace Tefel\JourneyPlanner\Model;

class Route
{

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var Stop[]
	 */
	private $stops;

	public function __construct($name, $stops = [])
	{
		$this->name = $name;
		$this->stops = $stops;
	} 

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getStops()
	{
		return $this->stops;
	}

	public function setStops(array $stops)
	{
		$this->stops = $stops;
	}

	public function addStop(Stop $stop)
	{
		if (!in_array($stop)) {
			$this->stops[] = $stops;
		}
	}

	public function removeStop(Stop $stop)
	{
		$this->stops = array_filter($this->stops, function(Stop $currentStop) use ($stop)
		{
			return $currentStop != $stop;
		});
	}
	
}