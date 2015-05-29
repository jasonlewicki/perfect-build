<?php 

namespace PerfectBuild\Runes\Glyphs;

class MagicPenetration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Magic Penetration');						
		$this->basic_effects_arr['magic_resistance_penetration_flat'] = 0.63;				
	}
}