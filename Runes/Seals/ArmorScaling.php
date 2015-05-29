<?php 

namespace PerfectBuild\Runes\Seals;

class ArmorScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Armor Scaling');						
		$this->basic_effects_arr['armor_scaling'] = 0.16;		
	}
}