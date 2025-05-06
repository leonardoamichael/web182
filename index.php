<?php
include 'functions/utility-functions.php';
include 'functions/name-functions.php';

$fileName = 'names-short-list.txt';

$fullNames = extractFullNames($fileName);
[$firstNames, $lastNames] = splitNames($fullNames);
[$validFullNames, $validFirstNames, $validLastNames] = validateNames($firstNames, $lastNames);

echo '<h1>Names - Results</h1>';

echo '<h2>All Names</h2>';
echo "<p>There are " . count($fullNames) . " total names</p>";
echo '<ul style="list-style-type:none">';
foreach ($fullNames as $name) {
    echo "<li>$name</li>";
}
echo '</ul>';

echo '<h2>All Valid Names</h2>';
echo "<p>There are " . count($validFullNames) . " valid names</p>";
echo '<ul style="list-style-type:none">';
foreach ($validFullNames as $name) {
    echo "<li>$name</li>";
}
echo '</ul>';

echo '<h2>Unique Valid Names</h2>';
$uniqueValidNames = array_unique($validFullNames);
echo "<p>There are " . count($uniqueValidNames) . " unique names</p>";
echo '<ul style="list-style-type:none">';
foreach ($uniqueValidNames as $name) {
    echo "<li>$name</li>";
}
echo '</ul>';

echo '<h2>Unique Last Names</h2>';
$uniqueLastNames = array_unique($validLastNames);
echo "<p>There are " . count($uniqueLastNames) . " unique last names</p>";

echo '<h2>Unique First Names</h2>';
$uniqueFirstNames = array_unique($validFirstNames);
echo "<p>There are " . count($uniqueFirstNames) . " unique first names</p>";

displayCommonNames($validLastNames, "Most Common Last Names");
displayCommonNames($validFirstNames, "Most Common First Names");
?>