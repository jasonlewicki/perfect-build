<?php 

namespace PerfectBuild\Runes\Quintessences;

class HealthRegeneration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health Regeneration');						
		$this->basic_effects_arr['health_regeneration_per_5'] = 2.7;		
	}
}