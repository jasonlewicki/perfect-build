<?php 

namespace PerfectBuild\Runes\Quintessences;

class HybridPenetration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Hybrid Penetration');						
		$this->basic_effects_arr['armor_penetration_flat'] = 1.79;				
		$this->basic_effects_arr['magic_resistance_penetration_flat'] = 1.4;	
	}
}