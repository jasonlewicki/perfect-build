<?php

namespace PerfectBuild\Engine;

Class Engine{
	
	protected $time;
	protected $tickrate;	
		
	public function __construct() {
		$this->time = 0;
		$this->tickrate = 10; // 10 times a second
	}
	
	// Step the game by 1 tick
	public function step(){
			
		$this->time += 1/$this->tickrate;
		
			
		return $this->time;
		
	}
	
}
