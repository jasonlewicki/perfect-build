<?php 

namespace PerfectBuild\Runes\Quintessences;

class CriticalChance extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Critical Chance');						
		$this->basic_effects_arr['critical_chance_percent'] = 0.0186;		
	}
}