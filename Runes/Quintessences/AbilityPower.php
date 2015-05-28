<?php 

namespace PerfectBuild\Runes\Quintessences;

class AbilityPower extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Ability Power');						
		$this->basic_effects_arr['ability_power'] = 4.95;		
	}
}