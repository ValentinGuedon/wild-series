<?php

namespace App\Service;

use App\Entity\Program;

class ProgramDuration
{
    public function calculate(Program $program): string
    {
        $totalMinutes = $program->getDuration();
        $days = floor($totalMinutes / 1440);
        $hours = floor(($totalMinutes % 1440) / 60);
        $minutes = $totalMinutes % 60;

        $durationString = "";
        if ($days > 0) {
            $durationString .= $days . " jour" . ($days > 1 ? "s" : "") . " ";
        }
        if ($hours > 0) {
            $durationString .= $hours . " heure" . ($hours > 1 ? "s" : "") . " ";
        }
        $durationString .= $minutes . " minute" . ($minutes > 1 ? "s" : "");

        return $durationString;
    }
}