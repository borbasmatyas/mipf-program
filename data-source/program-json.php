<?php
// A távoli URL meghatározása
$url = "https://madeinpecsfesztival.hu/programok/";

// Esemény dátuma
$eventDate = "2025-01-04";

// Kezdő időpont
$startTime = "10:00";

// Események hossza percben
$eventLength = 20;

// cURL használata az oldal tartalmának letöltésére
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL ellenőrzés tiltása, ha nem szükséges
$html = curl_exec($ch);
curl_close($ch);

// Ellenőrzés, hogy sikerült-e letölteni az oldal tartalmát
if (!$html) {
    die("Nem sikerült letölteni az oldal tartalmát.");
}

// DOMDocument inicializálása és az oldal beolvasása
libxml_use_internal_errors(true); // Hibaüzenetek elnyelése
$dom = new DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();

// XPath használata az adatok kinyeréséhez
$xpath = new DOMXPath($dom);

// Az összes helyszín beolvasása
$locations = $xpath->query('//div[contains(@class, "swiper-slide locations")]');
$json_array = [];

foreach ($locations as $location) {
    // Helyszín neve, hash és címe
    $locationName = $location->getAttribute('data-name');
    $locationHash = $location->getAttribute('data-hash');
    $locationAddress = $xpath->query('.//div[@class="text-wrapper"]/span', $location)->item(0)->textContent;

    // Programok beolvasása
    $programs = [];
    $programItems = $xpath->query('.//article[contains(@class, "programs-item")]', $location);
    $currentDateTime = new DateTime("$eventDate $startTime");
    foreach ($programItems as $program) {
        $time = $xpath->query('.//span', $program)->item(0)->textContent;
        $title = $xpath->query('.//h3', $program)->item(0)->textContent;

        // Kezdési időpont kiszámítása
        $programStartTime = DateTime::createFromFormat('H:i', trim($time));
        if ($programStartTime < new DateTime($startTime)) {
            $currentDateTime->modify('+1 day');
        }
        $programStartDateTime = clone $currentDateTime;
        $programStartDateTime->setTime($programStartTime->format('H'), $programStartTime->format('i'));

        // Befejezési időpont kiszámítása
        $programEndDateTime = clone $programStartDateTime;
        $programEndDateTime->modify("+$eventLength minutes");

        $programs[] = [
            'startTime' => $programStartDateTime->format('Y-m-d H:i'),
            'endTime' => $programEndDateTime->format('Y-m-d H:i'),
            'title' => trim($title)
        ];
    }

    // Helyszín hozzáadása az adathalmazhoz
    $json_array[] = [
        'locationName' => $locationName,
        'locationHash' => $locationHash,
        'locationAddress' => trim($locationAddress),
        'programs' => $programs
    ];
}


if (isset($return_json)) {
    // JSON állomány létrehozása
    $raw_json = json_encode($json_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($json_array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;  
}




