<?php

namespace PerfectBuild\Engine;

Class Engine{
	
	protected $time;
	protected $tick_rate;	
		
	public function __construct() {
		$this->time = 0;
		$this->tick_rate = 100; // 100 times a second
	}
	
	// Step the game by 1 tick
	public function step(){
			
		$this->time += 1/$this->tick_rate;
		
		// Engine Stuff	
			
		return $this->time;
		
	}
	
	// return tick rate
	public function tickRate(){		
		return $this->tick_rate;		
	}
	
}
