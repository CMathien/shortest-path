<?php

require_once "autoload.php";

// Map configuration
$map = new Map();
$map->buildMap(5,5);
$cells = $map->getCells();
// Test -> block the cell if row+column is divisible by four
foreach ($cells as $cell) {
	if (($cell->getRow() + $cell->getColumn())%4 == 0) {
		$cell->setOpen(false);
	}
}

// Path configuration
$path = new Path($map);
$path->setStart(1,4);
$path->setEnd(4,3);
echo $path->displayPathLength();
$path->displayPath();