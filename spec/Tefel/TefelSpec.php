<?php

namespace spec\Tefel;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tefel\Feed\StationsFeed;

class TefelSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('http://example/station-facilities.xml', 'app_id', 'app_token');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tefel\Tefel');
    }

    function it_gets_stations()
    {
        $this->getStations()->shouldNotBeNull();
        $this->getStations()->shouldBeAnInstanceOf(StationsFeed::class);
    }

}
