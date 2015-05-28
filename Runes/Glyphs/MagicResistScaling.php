<?php 

namespace PerfectBuild\Runes\Glyphs;

class MagicResistScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Magic Resist Scaling');						
		$this->basic_effects_arr['magic_resistance_scaling'] = 0.16;				
	}
}