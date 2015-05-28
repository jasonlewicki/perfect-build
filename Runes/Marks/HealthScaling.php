<?php 

namespace PerfectBuild\Runes\Marks;

class HealthScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health Scaling');						
		$this->basic_effects_arr['health_scaling'] = 0.54;		
	}
}