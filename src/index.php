<?php

require_once "autoload.php";

$map = new Map();
$map->buildMap(5,5);
var_dump($map->getCells());