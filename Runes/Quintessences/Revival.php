<?php 

namespace PerfectBuild\Runes\Quintessences;

class Revival extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Revival');						
		$this->basic_effects_arr['time_dead_percent'] = 0.05;				
	}
}