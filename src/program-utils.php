<?php

function load_program_json() {
    $return_json = true;
    include($_SERVER['DOCUMENT_ROOT'] . '/data-source/program-json.php');
    $jsonData = json_decode($raw_json, true);

    if (!$jsonData) {
        die("Hiba: Nem sikerült betölteni a JSON adatot.");
    }

    return $jsonData;
}

function get_program_time_range(array $jsonData) {
    $first = null;
    $last = null;

    foreach ($jsonData as $location) {
        foreach ($location['programs'] as $program) {
            $start = strtotime($program['startTime']);
            $end = strtotime($program['endTime']);

            if ($first === null || $start < $first) {
                $first = $start;
            }
            if ($last === null || $end > $last) {
                $last = $end;
            }
        }
    }

    return [$first, $last];
}
