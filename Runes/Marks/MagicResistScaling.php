<?php 

namespace PerfectBuild\Runes\Marks;

class MagicResistScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Magic Resist Scaling');						
		$this->basic_effects_arr['magic_resistance_scaling'] = 0.07;				
	}
}