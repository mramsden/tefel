<?php

namespace spec\Tefel\Feed;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\SpecHelper;
use Tefel\Feed\Station;
use Tefel\Feed\StationsFeed;

class StationsFeedSpec extends ObjectBehavior
{
    use SpecHelper;

    function let()
    {
        $client = new Client();

        $plugin = new MockPlugin();
        $plugin->addResponse(new Response(200, ['Content-Type' => 'text/xml'],
            file_get_contents(__DIR__ . '/station-facilities.xml')));
        $client->addSubscriber($plugin);

        $this->beConstructedWith('http://example/station-facilities.xml');
        $this->setClient($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(StationsFeed::class);
    }

    function it_gets_stations()
    {
        $this->shouldHaveCount(302);
    }

    function it_shows_a_station_exists()
    {
        $this->offsetExists(0)->shouldBe(true);
    }

    function it_gets_a_station()
    {
        $this[0]->shouldHaveType(Station::class);
        $this[0]->getName()->shouldBe('Acton Town');
        $this[0]->getLocation()->longitude->shouldBe(-280251);
        $this[0]->getLocation()->latitude->shouldBe(51502750);
        $this[0]->getLines()->shouldHaveCount(2);
        $this[0]->getLines()->shouldHaveValue('District');
        $this[0]->getLines()->shouldHaveValue('Piccadilly');
    }

    function it_is_immutable()
    {
        $this->shouldThrow(\Exception::class)->duringOffsetSet(0, "Foo");
        $this->shouldThrow(\Exception::class)->duringOffsetUnset(0, "Foo");
    }

}
