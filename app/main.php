<?php

require __DIR__ . '/MatchNode.php';
require __DIR__ . '/tools.php';

/**
 * Write info and end script
 */
function writeExit($message) {
    echo $message . "\n";
    exit(1);
}

if ($argc < 2) {
    writeExit("Usage: php main.php <number_of_players>");
}

$numberOfPlayer = (int)$argv[1];

if ($numberOfPlayer <= 0 || $numberOfPlayer > PHP_INT_MAX) {
    writeExit("Number of players must be int between 1 and " . PHP_INT_MAX);
}

$rounds = log($numberOfPlayer, 2);
if ($rounds != floor($rounds)) {
    writeExit("Number of players must be 2 to some power");
}

$root = createTree($rounds);
$maxRows = $numberOfPlayer / 2;

$env = [];
if (file_exists('.env')) {
    $env = parse_ini_file(__DIR__ . '/.env');
}

$width = $env["IMAGE_WIDTH"] ?? 1000;
$height = $env["IMAGE_HEIGHT"] ?? 800;
$imagePath = $env["IMAGE_PATH"] ?? 'team_matches.png';

drawTree($root, $rounds, $maxRows, $width, $height, $imagePath);
writeExit("Image was created: '" . $imagePath . "'");