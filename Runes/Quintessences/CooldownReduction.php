<?php 

namespace PerfectBuild\Runes\Quintessences;

class CooldownReduction extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Cooldown Reduction');						
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.025;		
	}
}