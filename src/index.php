<?php

require_once "autoload.php";

$map = new Map();
$map->buildMap(5,5);
$cells = $map->getCells();

// Test -> block the cell if row+column is divisible by four
foreach ($cells as $cell) {
	if (($cell->getRow() + $cell->getColumn())%4 == 0) {
		$cell->setOpen(false);
	}
}