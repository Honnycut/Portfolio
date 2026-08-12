<?php

$jsonPath = __DIR__ . '/../data/selected-projects.json';

if (!file_exists($jsonPath)) {
    die('JSON-filen blev ikke fundet.');
}

$jsonData = file_get_contents($jsonPath);

$data = json_decode($jsonData, true);

if ($data === null) {
    die('Der er en fejl i JSON-filen.');
}

$projects = $data['projects'] ?? [];
