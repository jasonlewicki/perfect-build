<?php 

namespace PerfectBuild\Runes\Quintessences;

class ManaScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Mana Scaling');						
		$this->basic_effects_arr['mana_scaling'] = 4.17;				
	}
}