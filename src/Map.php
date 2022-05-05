<?php

class Map
{
	private $cells = [];

	/**
	 * Get the value of cells
	 */ 
	public function getCells(): array
	{
		return $this->cells;
	}

	/**
	 * Add a cell to the map
	 *
	 * @param  Cell $cell
	 * @return Map
	 */
	public function addCell(Cell $cell): Map
	{
		$this->cells[] = $cell;
		return $this;
	}
	
	/**
	 * Build the map with a given number of rows and columns
	 *
	 * @param  mixed $rows
	 * @param  mixed $columns
	 * @return Map
	 */
	public function buildMap(int $rows, int $columns): Map
	{
		if ($rows <= 0) {
			throw new Exception("Number of rows requires a positive number", 1);
		}
		if ($columns <= 0) {
			throw new Exception("Number of columns requires a positive number", 1);
		}

		for ($i = 0; $i < $rows; $i++) {
			for ($j = 0; $j < $columns; $j++) {
				$this->addCell(new Cell($i, $j, true));
			}
		}
		return $this;
	}
	
	/**
	 * Display a given path on the map
	 *
	 * @param  mixed $path
	 * @return void
	 */
	public function displayPath( $path)
	{

	}
}
