<?php namespace Tefel\JourneyPlanner\Model;

use PHPCoord\OSRef;

class Timetable
{

	private $document;

	public function __construct($timetablePath)
	{
		$this->document = simplexml_load_file($timetablePath);
	}

	public function getStopPoints()
	{
		$stopPoints = [];

		foreach ($this->document->StopPoints->StopPoint as $stopPoint) {
			$stopPoints[] = $this->stopPointFromTimetable($stopPoint);
		}

		return $stopPoints;
	}

	public function getRoutes()
	{
		$routes = [];

		foreach ($this->document->Routes->Route as $route)
		{
			$routes[] = $this->routeFromTimetable($route);
		}

		return $routes;
	}

	private function stopPointFromTimetable($timetableStopPoint)
	{
		$atcoCode = (string) $timetableStopPoint->AtcoCode;
		$commonName = (string) $timetableStopPoint->Descriptor->CommonName;
		$osRef = new OSRef((int) $timetableStopPoint->Place->Location->Easting, (int) $timetableStopPoint->Place->Location->Northing);
		$latLng = $osRef->toLatLng();
		$latLng->OSGB36ToWGS84();

		$stopPoint = new \stdClass;
		$stopPoint->name = $commonName;
		$stopPoint->atcoCode = $atcoCode;
		$stopPoint->longitude = $latLng->lng;
		$stopPoint->latitude = $latLng->lat;

		return $stopPoint;
	}

	private function routeFromTimetable($timetableRoute)
	{
		$privateCode = (string) $timetableRoute->PrivateCode;
		$description = (string) $timetableRoute->Description;
		$routeSectionRef = (string) $timetableRoute->RouteSectionRef;

		$route = new \stdClass;
		$route->code = $privateCode;
		$route->description = $description;
		$route->routeSectionRef = $routeSectionRef;

		return $route;
	}

}
