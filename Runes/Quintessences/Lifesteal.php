<?php 

namespace PerfectBuild\Runes\Quintessences;

class Lifesteal extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Lifesteal');						
		$this->basic_effects_arr['lifesteal_percent'] = 0.015;				
	}
}