<?php 

namespace PerfectBuild\Runes\Quintessences;

class ManaRegenerationScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Mana Regeneration Scaling');						
		$this->basic_effects_arr['mana_regeneration_scaling_per_5'] = 0.24;				
	}
}