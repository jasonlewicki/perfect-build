<?php 

namespace PerfectBuild\Runes\Glyphs;

class HealthScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Health Scaling');						
		$this->basic_effects_arr['health_scaling'] = 0.54;		
	}
}