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
$data = [];

foreach ($locations as $location) {
    // Helyszín neve, hash és címe
    $locationName = $location->getAttribute('data-name');
    $locationHash = $location->getAttribute('data-hash');
    $locationAddress = $xpath->query('.//div[@class="text-wrapper"]/span', $location)->item(0)->textContent;

    // Programok beolvasása
    $programs = [];
    $programItems = $xpath->query('.//article[contains(@class, "programs-item")]', $location);
    foreach ($programItems as $program) {
        $time = $xpath->query('.//span', $program)->item(0)->textContent;
        $title = $xpath->query('.//h3', $program)->item(0)->textContent;
        $programs[] = [
            'time' => trim($time),
            'title' => trim($title)
        ];
    }

    // Helyszín hozzáadása az adathalmazhoz
    $data[] = [
        'locationName' => $locationName,
        'locationHash' => $locationHash,
        'locationAddress' => trim($locationAddress),
        'programs' => $programs
    ];
}

// JSON generálása
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
