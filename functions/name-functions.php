<?php

function extractFullNames($fileName) {
    $fullNames = [];
    $lineNumber = 0;

    $FH = fopen($fileName, "r");
    $nextName = fgets($FH);

    while (!feof($FH)) {
        if ($lineNumber % 2 == 0) {
            $fullNames[] = trim(substr($nextName, 0, strpos($nextName, " --")));
        }
        $lineNumber++;
        $nextName = fgets($FH);
    }

    fclose($FH);
    return $fullNames;
}

function splitNames($fullNames) {
    $firstNames = [];
    $lastNames = [];

    foreach ($fullNames as $fullName) {
        $commaPos = strpos($fullName, ",");
        $lastNames[] = substr($fullName, 0, $commaPos);
        $firstNames[] = trim(substr($fullName, $commaPos + 1));
    }

    return [$firstNames, $lastNames];
}

function validateNames($firstNames, $lastNames) {
    $validFirstNames = [];
    $validLastNames = [];
    $validFullNames = [];

    for ($i = 0; $i < count($firstNames); $i++) {
        if (ctype_alpha($lastNames[$i] . $firstNames[$i])) {
            $validFirstNames[] = $firstNames[$i];
            $validLastNames[] = $lastNames[$i];
            $validFullNames[] = $lastNames[$i] . ", " . $firstNames[$i];
        }
    }

    return [$validFullNames, $validFirstNames, $validLastNames];
}

function displayCommonNames($nameArray, $title) {
    $counts = array_count_values($nameArray);
    arsort($counts);

    echo "<h2>$title</h2>";
    echo '<ul style="list-style-type:none">';
    foreach (array_slice($counts, 0, 5) as $name => $count) {
        echo "<li>$name ($count)</li>";
    }
    echo '</ul>';
}