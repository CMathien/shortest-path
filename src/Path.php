<?php

class Path
{
	private Map $map;
	private Cell $start;
	private Cell $end;
	private $shortestPath = [];

	public function __construct(Map $map)
	{
		$this->map = $map;
	}

	/**
	 * Set the value of start
	 *
	 * @return  self
	 */ 
	public function setStart($row, $column)
	{
		$cells = $this->map->getCells();
		foreach ($cells as $cell) {
			if ( $cell->getRow() == $row && $cell->getColumn() == $column ) {
				if ($cell->getOpen() == false) {
					throw new Exception("Cell should be open", 1);
				}
				$this->start = $cell;
			}
		}
		if (!isset($this->start)) {
			throw new Exception("Cell not in map", 1);
		}
		return $this;
	}

	/**
	 * Set the value of end
	 *
	 * @return  self
	 */ 
	public function setEnd($row, $column)
	{
		$cells = $this->map->getCells();
		foreach ($cells as $cell) {
			if ( $cell->getRow() == $row && $cell->getColumn() == $column ) {
				if ($cell->getOpen() == false) {
					throw new Exception("Cell should be open", 1);
				}
				$this->end = $cell;
			}
		}
		if (!isset($this->end)) {
			throw new Exception("Cell not in map", 1);
		}
		return $this;
	}

	/**
	 * Return the stored path length
	 *
	 * @return void
	 */
	public function displayPathLength()
	{
		return "Path length: ". count($this->shortestPath). " steps.";
	}
	
	/**
	 * Search the shortest path between two cells on a map
	 *
	 * @return void
	 */
	public function getShortestPath(Cell $currentPoint, array $currentPath=[])
	{

		// Add the current point to the path
		$currentPath[] = $currentPoint;

		//If the path is longer than the previous shortest path -> do nothing
		if (!empty($this->shortestPath) && count($currentPath) >= count($this->shortestPath)) { 
			return;
		}

		// If current point = end cell -> store as shortest path
		if ($currentPoint == $this->end) {  
			$this->shortestPath = $currentPath;
			return;
		}

		// Get the four cells around current point (or less if cells not in map)
		$points = [];
		foreach ($this->map->getCells() as $cell) {
			if (($cell->getRow() == $currentPoint->getRow()-1 && $cell->getColumn() == $currentPoint->getColumn()) || ($cell->getRow() == $currentPoint->getRow()+1 && $cell->getColumn() == $currentPoint->getColumn()) || ($cell->getRow() == $currentPoint->getRow() && $cell->getColumn() == $currentPoint->getColumn()-1) || ($cell->getRow() == $currentPoint->getRow() && $cell->getColumn() == $currentPoint->getColumn()+1)) {
				$points[] = $cell;
			}
		}

		// Check every accessible cell
		foreach ($points as $point) {
			// Check if cell is open
			if ($point->getOpen() == false) {
				continue;
			}
			//Check if the cell already is in path
			if (in_array($point, $currentPath)) {
				continue;
			}
			// Recursive call to getShortestPath()
			$this->getShortestPath($point, $currentPath);
		}
	}


	/**
	 * Display a given path on the map
	 *
	 * @return void
	 */
	public function displayPath()
	{
		$row = 0;
		foreach ($this->map->getCells() as $cell) {
			if ($cell->getRow() != $row) {
				echo "<br>";
				$row = $cell->getRow();
			}
			echo "|";
			if (($pos = array_search($cell, $this->shortestPath)) !== false) {
				switch ($pos) {
					case 0:
						echo "D";
						break;
					case count($this->shortestPath)-1:
						echo "A";
						break;
					default:
						echo "o";
						break;
				}
			}
			else {
				echo "x";
			}
			echo "|";
		}
	}

	/**
	 * Get the value of start
	 */ 
	public function getStart()
	{
		return $this->start;
	}

	/**
	 * Get the value of end
	 */ 
	public function getEnd()
	{
		return $this->end;
	}
}