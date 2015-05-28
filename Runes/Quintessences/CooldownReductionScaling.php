<?php 

namespace PerfectBuild\Runes\Quintessences;

class CoodownReductionScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Cooldown Reduction Scaling');						
		$this->basic_effects_arr['cooldown_reduction_scaling_percent'] = 0.28;		
	}
}