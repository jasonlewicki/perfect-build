<?php 

namespace PerfectBuild\Runes\Marks;

class AbilityPower extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Ability Power');						
		$this->basic_effects_arr['ability_power'] = 0.59;		
	}
}