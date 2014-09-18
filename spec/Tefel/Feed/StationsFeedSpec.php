<?php

namespace spec\Tefel\Feed;

use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;
use Guzzle\Plugin\Mock\MockPlugin;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StationsFeedSpec extends ObjectBehavior
{
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
        $this->shouldHaveType('Tefel\Feed\StationsFeed');
    }

    function it_gets_stations()
    {
        $this->shouldHaveCount(302);
    }
}
