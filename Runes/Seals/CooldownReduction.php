<?php 

namespace PerfectBuild\Runes\Seals;

class CoodownReduction extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Cooldown Reduction');						
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.36;		
	}
}