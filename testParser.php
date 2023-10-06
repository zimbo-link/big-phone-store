#!/usr/bin/php
<?php

$ipaths[] = 'tests';
$ipaths[] = 'parser';
set_include_path(implode(PATH_SEPARATOR, $ipaths));

spl_autoload_register(function ($class) {
    $paths = explode(PATH_SEPARATOR, get_include_path());
    foreach ($paths AS $path) {
        $file = $path . '/' . $class . '.class.php';
        if (is_file($file)) {
              include($file);
              return;
        }
    }
});

$testCSV = new TestCSV;
print( '>>> Run CSV tests:' . PHP_EOL);
print( '>>> testHeader' . PHP_EOL);
$testCSV->testHeader(7);
print( '>>> testRead' . PHP_EOL);
$testCSV->testRead(5);
print( '>>> testWrite' . PHP_EOL);
$testCSV->testWrite(6);
print( '>>> assertColumnOrder' . PHP_EOL);
$header = [
    "make",
    "model",
    "condition",
    "grade",
    "capacity",
    "network",
    "colour",
    "count"
];
$testCSV->assertColumnOrder($header);
print( '>>> CSV TESTS COMPLETE!' . PHP_EOL);


$testTSV = new TestTSV;
print( '>>> Run CSV tests:' . PHP_EOL);
print( '>>> testHeader' . PHP_EOL);
$testTSV->testHeader(7);
print( '>>> testRead' . PHP_EOL);
$testTSV->testRead(5);
print( '>>> testWrite' . PHP_EOL);
$testTSV->testWrite(6);
print( '>>> assertColumnOrder' . PHP_EOL);
$header = [
    "make",
    "model",
    "condition",
    "grade",
    "capacity",
    "colour",
    "network",
    "count"
];
$testTSV->assertColumnOrder($header);
print( '>>> CSV TESTS COMPLETE!' . PHP_EOL);