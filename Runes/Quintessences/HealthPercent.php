<?php 

namespace PerfectBuild\Runes\Quintessences;

class HealthPercent extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Health Percent');						
		$this->basic_effects_arr['health_percent_percent'] = 0.015;		
	}
}