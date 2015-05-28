<?php 

namespace PerfectBuild\Runes\Seals;

class Gold extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Gold');						
		$this->basic_effects_arr['gold_per_10'] = 0.25;		
	}
}