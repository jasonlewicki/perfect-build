<?php 

namespace PerfectBuild\Runes\Quintessences;

class MovementSpeed extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Movement Speed');						
		$this->basic_effects_arr['movement_speed_percent'] = 0.015;				
	}
}