<?php 

namespace PerfectBuild\Runes\Seals;

class HealthRegenerationScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health Regeneration Scaling');						
		$this->basic_effects_arr['health_regeneration_scaling_per_5'] = 0.11;		
	}
}