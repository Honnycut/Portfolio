<?php

$jsonPath = __DIR__ . '/../data/udvalgte_projekter.json';

if (!file_exists($jsonPath)) {
    die('JSON-filen blev ikke fundet.');
}

$jsonData = file_get_contents($jsonPath);

$data = json_decode($jsonData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die('Fejl i JSON-filen: ' . json_last_error_msg());
}

return $data['projects'] ?? [];