<?php
// A távoli URL meghatározása
$url = "https://madeinpecsfesztival.hu/programok/";

// Esemény dátuma
$eventDate = "2026-01-17";

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
$json_data = [];

foreach ($locations as $location) {
    // Helyszín neve, hash és címe
    $locationName = $location->getAttribute('data-name');
    $locationHash = $location->getAttribute('data-hash');
    $locationAddress = $xpath->query('.//div[@class="text-wrapper"]/span', $location)->item(0)->textContent;

    // Programok beolvasása
    $programs = [];
    $programItems = $xpath->query('.//article[contains(@class, "programs-item")]', $location);
    $currentDateTime = new DateTime("$eventDate $startTime");
    $previousTime = new DateTime($startTime);
    foreach ($programItems as $program) {

        $time = $xpath->query('.//span', $program)->item(0)->textContent;
        $title = $xpath->query('.//h3', $program)->item(0)->textContent;

        // Ellenőrizzük, hogy tartalmazza-e az "ELMARAD" szót
        $isCanceled = stripos($title, 'ELMARAD') !== false;
        
        // A kezdő időpont helyes beállítása
        $programStartTime = DateTime::createFromFormat('Y-m-d H:i', "$eventDate $time");
        if (!$programStartTime) {
            // Hiba esetén dobjunk figyelmeztetést
            error_log("Nem sikerült feldolgozni az időpontot: $time a következő programhoz: $title");
            continue;
        }
        
        // Ellenőrizzük, hogy az idő nem lépett-e át a következő napra
        if ($programStartTime < $currentDateTime) {
            $programStartTime->modify('+1 day');
        }
        $currentDateTime = clone $programStartTime;
        
        // Befejezési idő kiszámítása
        $programEndTime = clone $programStartTime;
        $programEndTime->modify("+$eventLength minutes");
        
        // Esemény hozzáadása
        $programs[] = [
            'startTime' => $programStartTime->format('Y-m-d H:i'),
            'endTime' => $programEndTime->format('Y-m-d H:i'),
            'title' => trim($title),
            'isCanceled' => $isCanceled
        ];
        
    }

    // Helyszín hozzáadása az adathalmazhoz
    $json_data[] = [
        'locationName' => $locationName,
        'locationHash' => $locationHash,
        'locationAddress' => trim($locationAddress),
        'programs' => $programs
    ];
}



if (isset($return_json)) {
    // JSON állomány létrehozása
    $raw_json = json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} else {

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    exit;  
}







