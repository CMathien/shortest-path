<?php

class Path
{
	private Map $map;
	private Cell $start;
	private Cell $end;
	private $pathCells = [];

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
				$this->addCell($this->start);
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
	 * Add a cell to the path
	 *
	 * @param  Cell $cell
	 * @return Path
	 */
	public function addCell(Cell $cell): Path
	{
		$this->pathCells[] = $cell;
		return $this;
	}
	
	
	/**
	 * Return the stored path length
	 *
	 * @return void
	 */
	public function displayPathLength()
	{
		return "Path length: ". count($this->pathCells);
	}
	
	/**
	 * Search the shortest path between two cells on a map
	 *
	 * @return void
	 */
	public function searchShortestPath()
	{
		
	}

	/**
	 * Get the value of pathCells
	 */ 
	public function getPathCells(): array
	{
		return $this->pathCells;
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
				echo PHP_EOL;
				$row = $cell->getRow();
			}
			echo "|";
			if (($pos = array_search($cell, $this->getPathCells())) !== false) {
				switch ($pos) {
					case 0:
						echo "D";
						break;
					case count($this->getPathCells())-1:
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
}