<?php 

namespace PerfectBuild\Runes\Glyphs;

class AbilityPower extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Ability Power');						
		$this->basic_effects_arr['ability_power'] = 1.19;		
	}
}