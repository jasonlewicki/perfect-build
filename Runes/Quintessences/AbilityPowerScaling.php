<?php 

namespace PerfectBuild\Runes\Quintessences;

class AbilityPowerScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Ability Power Scaling');						
		$this->basic_effects_arr['ability_power_scaling'] = 0.43;		
	}
}