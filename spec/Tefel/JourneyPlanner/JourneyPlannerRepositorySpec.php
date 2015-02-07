<?php
namespace spec\Tefel\JourneyPlanner;

use PhpSpec\ObjectBehavior;
use spec\SpecHelper;
use Tefel\JourneyPlanner\JourneyPlannerRepository;
use Tefel\JourneyPlanner\UnrecognizedLineIdentifierException;

class JourneyPlannerRepositorySpec extends ObjectBehavior
{
    use SpecHelper;

    public function it_is_initializable()
    {
        $this->shouldHaveType(JourneyPlannerRepository::class);
    }

    public function it_rejects_invalid_line_identifier_with_exception()
    {
        $this->shouldThrow(UnrecognizedLineIdentifierException::class)
            ->duringGetAllServices("ABC");
    }

    public function it_accepts_valid_line_identifier_for_get_all_services()
    {
        $validLineIdentifiers = ["BAK", "CEN", "CIR", "DIS", "HAM", "JUB",
            "MET", "NTN", "PIC", "VIC", "WAT", "DLR"];
        foreach ($validLineIdentifiers as $lineIdentifier) {
            $this->getAllServices($lineIdentifier)->shouldReturn([]);
        }
    }

}
