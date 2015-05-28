<?php 

namespace PerfectBuild\Runes\Glyphs;

class AbilityPowerScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Ability Power Scaling');						
		$this->basic_effects_arr['ability_power_scaling'] = 0.17;		
	}
}