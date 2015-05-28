<?php 

namespace PerfectBuild\Runes\Seals;

class HealthPercent extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health Percent');						
		$this->basic_effects_arr['health_percent'] = 0.5;		
	}
}