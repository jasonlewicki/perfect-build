<?php 

namespace PerfectBuild\Runes\Marks;

class MagicPenetration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Magic Penetration');						
		$this->basic_effects_arr['magic_resistance_penetration_flat'] = 0.87;				
	}
}