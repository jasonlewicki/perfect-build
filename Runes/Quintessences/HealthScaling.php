<?php 

namespace PerfectBuild\Runes\Quintessences;

class HealthScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Health Scaling');						
		$this->basic_effects_arr['health_scaling'] = 2.7;		
	}
}