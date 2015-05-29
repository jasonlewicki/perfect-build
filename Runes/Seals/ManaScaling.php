<?php 

namespace PerfectBuild\Runes\Seals;

class ManaScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Mana Scaling');						
		$this->basic_effects_arr['mana_scaling'] = 1.17;				
	}
}