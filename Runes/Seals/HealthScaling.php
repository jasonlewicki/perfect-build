<?php 

namespace PerfectBuild\Runes\Seals;

class HealthScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health Scaling');						
		$this->basic_effects_arr['health_scaling'] = 1.33;		
	}
}