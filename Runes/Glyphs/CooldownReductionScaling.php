<?php 

namespace PerfectBuild\Runes\Glyphs;

class CooldownReductionScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Cooldown Reduction Scaling');						
		$this->basic_effects_arr['cooldown_reduction_scaling_percent'] = 0.0009;		
	}
}