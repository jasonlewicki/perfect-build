<?php 

namespace PerfectBuild\Runes\Marks;

class CriticalChance extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Critical Chance');						
		$this->basic_effects_arr['critical_chance_percent'] = 0.0093;		
	}
}