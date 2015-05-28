<?php 

namespace PerfectBuild\Runes\Marks;

class HybridPenetration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Hybrid Penetration');						
		$this->basic_effects_arr['armor_penetration_flat'] = 0.9;				
		$this->basic_effects_arr['magic_resistance_penetration_flat'] = 0.62;	
	}
}