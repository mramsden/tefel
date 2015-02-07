<?php namespace Tefel\JourneyPlanner\Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Tefel\JourneyPlanner\Model\Timetable;

class ImportJourneyPlannerTimetable extends Command
{

    protected $name = "tefel:import-timetable";

    protected $description = "Attempts to import the TFL Journey Planner timetables";

    public function fire()
    {
        $timetablePath = $this->argument('timetable-path');

        $memoryUsage = new \stdClass;
        $memoryUsage->start = $this->formatBytes(memory_get_usage());

        $timetable = new Timetable($timetablePath);

        $climate = new \League\CLImate\CLImate;

        $memoryUsage->peak = $this->formatBytes(memory_get_peak_usage());
        $memoryUsage->end = $this->formatBytes(memory_get_usage());

        $climate->out('Stop Points');
        $climate->table($timetable->getStopPoints());
        $climate->border();
        $climate->table($timetable->getRoutes());
        $climate->border();
        $climate->out('Memory Usage');
        $climate->table([$memoryUsage]);
    }

    protected function getArguments()
    {
        return [
            ['timetable-path', InputArgument::REQUIRED]
        ];
    }

    private function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

}