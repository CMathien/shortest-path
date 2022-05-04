<?php

class Cell 
{
	private int $row;
	private int $column;
	private bool $open; // 1: can be used

	public function __construct(int $row, int $column, bool $open)
	{
		$this->row = $row;
		$this->column = $column;
		$this->open = $open;
	}

	/**
	 * Get the value of row
	 */ 
	public function getRow():int
	{
		return $this->row;
	}

	/**
	 * Get the value of column
	 */ 
	public function getColumn():int
	{
		return $this->column;
	}

	/**
	 * Get the value of open
	 */ 
	public function getOpen():bool
	{
		return $this->open;
	}
}