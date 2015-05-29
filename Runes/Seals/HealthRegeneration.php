<?php 

namespace PerfectBuild\Runes\Seals;

class HealthRegeneration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Health Regeneration');						
		$this->basic_effects_arr['health_regeneration_per_5'] = 0.56;		
	}
}