<?php namespace spec\Tefel\Feed;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SimpleXMLElement;

class StationSpec extends ObjectBehavior
{

    function let()
    {
        $this->beConstructedWith(new SimpleXMLElement(self::$sampleXml));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Tefel\Feed\Station');
    }

    function it_returns_name()
    {
        $this->getName()->shouldBe('Acton Town');
    }

    function it_returns_location()
    {
        $this->getLocation()->longitude->shouldBe(-280251);
        $this->getLocation()->latitude->shouldBe(51502750);
    }

    function it_returns_lines()
    {
        $this->getLines()->shouldHaveCount(2);
        $this->getLines()->shouldHaveValue('District');
        $this->getLines()->shouldHaveValue('Piccadilly');
    }

    function it_returns_lines_without_serving_lines()
    {
        $this->beConstructedWith(new SimpleXMLElement(self::$noServingLinesSampleXml));

        $this->getLines()->shouldHaveCount(1);
        $this->getLines()->shouldHaveValue('Piccadilly');
    }

    public function getMatchers()
    {
        return [
            'haveValue' => function($subject, $value)
            {
                return in_array($value, $subject);
            },
        ];
    }

    private static $sampleXml = <<<SAMPLE_XML
<station id="1000002" type="tube" xmlns="">
    <name>Acton Town</name>
    <contactDetails>
        <address>Acton Town Station, London Underground Ltd., Gunnersbury Lane, London, W3 8HN</address>
        <phone>0845 330 9875</phone>
    </contactDetails>
    <servingLines>
        <servingLine>District</servingLine>
        <servingLine>Piccadilly</servingLine>
    </servingLines>
    <zones>
        <zone>3</zone>
    </zones>
    <facilities>
        <facility name="Ticket Halls">1</facility>
        <facility name="Lifts">0</facility>
        <facility name="Escalators">0</facility>
        <facility name="Gates">4</facility>
        <facility name="Toilets">yes</facility>
        <facility name="Photo Booths">2</facility>
        <facility name="Cash Machines">2</facility>
        <facility name="Payphones">4</facility>
        <facility name="Car park">no</facility>
        <facility name="Vending Machines">4 snack, 0 drink</facility>
        <facility name="Help Points">0 on platforms, 0 in ticket halls, 0 elsewhere</facility>
        <facility name="Bridge">yes</facility>
        <facility name="Waiting Room">yes</facility>
        <facility name="Other Facilities">subway to street.</facility>
    </facilities>
    <entrances xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <entrance>
            <name>Gunnersbury Lane</name>
            <entranceToBookingHall>Level</entranceToBookingHall>
            <bookingHallToPlatform>
                <path>
                    <heading>EASTBOUND</heading>
                    <pathDescription>14, 14 stairs down</pathDescription>
                </path>
                <path>
                    <heading>WESTBOUND</heading>
                    <pathDescription>14,14 stairs down</pathDescription>
                </path>
            </bookingHallToPlatform>
            <platformToTrain>
                <trainName>District</trainName>
                <platformToTrainSteps>LEVEL_300</platformToTrainSteps>
            </platformToTrain>
            <platformToTrain>
                <trainName>Piccadilly </trainName>
                <platformToTrainSteps>LEVEL_100</platformToTrainSteps>
            </platformToTrain>
        </entrance>
    </entrances>
    <openingHours>
        <openingHour>
            <entrance>Main entrance: </entrance>
            <timeIntervals type="Mon-Fri">
                <timeInterval>
                    <from>05:30</from>
                    <to>21:30</to>
                </timeInterval>
            </timeIntervals>
            <timeIntervals type="Sat">
                <timeInterval>
                    <from>06:00</from>
                    <to>21:30</to>
                </timeInterval>
            </timeIntervals>
            <timeIntervals type="Sun">
                <timeInterval>
                    <from>07:00</from>
                    <to>23:00</to>
                </timeInterval>
            </timeIntervals>
        </openingHour>
    </openingHours>
    <Placemark>
        <name>Acton Town Station</name>
        <description>Acton Town Station, London Underground Ltd., Gunnersbury Lane, London, W3 8HN</description>
        <Point>
            <coordinates>-.280251203536110600,51.502749773000570000,0</coordinates>
        </Point>
        <styleUrl>#tubeStyle</styleUrl>
    </Placemark>
</station>
SAMPLE_XML;

    private static $noServingLinesSampleXml = <<<NO_SERVING_LINES_SAMPLE_XML
<station id="1000104" type="tube" xmlns="">
<name>Heathrow Terminal 4</name>
<contactDetails>
    <address>Heathrow T4 Station, London Underground Ltd., Hthrw Airport complex, Trmnl 4, Hounslow, Middx</address>
    <phone>
    </phone>
</contactDetails>
<servingLines>
</servingLines>
<zones>
    <zone>6</zone>
</zones>
<facilities>
    <facility name="Ticket Halls">1</facility>
    <facility name="Lifts">0</facility>
    <facility name="Escalators">0</facility>
    <facility name="Gates">3</facility>
    <facility name="Toilets">no</facility>
    <facility name="Photo Booths">1</facility>
    <facility name="Cash Machines">0</facility>
    <facility name="Payphones">4 in ticket halls, 1 on platforms</facility>
    <facility name="Car park">no</facility>
    <facility name="Vending Machines">3 snack, 0 drink</facility>
    <facility name="Help Points">0 on platforms, 0 in ticket halls, 0 elsewhere</facility>
    <facility name="Bridge">no</facility>
    <facility name="Waiting Room">no</facility>
    <facility name="Other Facilities">post office style queuing for tickets, subway to street.</facility>
</facilities>
<entrances xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <entrance>
        <name>Terminal 4</name>
        <entranceToBookingHall>Lift (or escalator or 15, 9 stairs) down, ramp down</entranceToBookingHall>
        <bookingHallToPlatform>
            <pointName />
            <pathDescription>Level</pathDescription>
        </bookingHallToPlatform>
        <platformToTrain>
            <trainName>Piccadilly </trainName>
            <platformToTrainSteps>LEVEL_200</platformToTrainSteps>
        </platformToTrain>
    </entrance>
    <entrance>
        <name>Terminal 4</name>
        <entranceToBookingHall>Lift (or escalator or 15, 9 stairs) down, ramp down</entranceToBookingHall>
        <bookingHallToPlatform>
            <pointName />
            <pathDescription>Level</pathDescription>
        </bookingHallToPlatform>
        <platformToTrain>
            <trainName>Piccadilly </trainName>
            <platformToTrainSteps>LEVEL_200</platformToTrainSteps>
        </platformToTrain>
    </entrance>
</entrances>
<openingHours>
    <openingHour>
        <entrance>Main entrance: </entrance>
        <timeIntervals type="Mon-Fri">
            <timeInterval>
                <from>05:30</from>
                <to>22:30</to>
            </timeInterval>
        </timeIntervals>
        <timeIntervals type="Sat">
            <timeInterval>
                <from>05:30</from>
                <to>22:30</to>
            </timeInterval>
        </timeIntervals>
        <timeIntervals type="Sun">
            <timeInterval>
                <from>05:45</from>
                <to>22:30</to>
            </timeInterval>
        </timeIntervals>
    </openingHour>
</openingHours>
<Placemark>
    <name>
        Heathrow Terminal 4 Station
    </name>
    <description>Heathrow T4 Station, London Underground Ltd., Hthrw Airport complex, Trmnl 4, Hounslow, Middx</description>
    <Point>
        <coordinates>
            -.446058766977937300,51.458553104092005000,0
        </coordinates>
    </Point>
    <styleUrl>#tubeStyle</styleUrl>
</Placemark>
</station>
NO_SERVING_LINES_SAMPLE_XML;

}
