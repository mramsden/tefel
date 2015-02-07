<?php
namespace Tefel\JourneyPlanner;

class JourneyPlannerRepository
{

    private $validLines = ["BAK", "CEN", "CIR", "DIS", "HAM", "JUB", "MET", "NTN",
        "PIC", "VIC", "WAT", "DLR"];

    /**
     * Gets all services for the supplied line identifer.
     *
     * @param string $line
     *
     * @return array|Service
     */
    public function getAllServices($line)
    {
        $this->checkLine($line);

        return [];
    }

    private function checkLine($line)
    {
        if (!in_array($line, $this->validLines)) {
            throw new UnrecognizedLineIdentifierException();
        }
    }

}
