<?php 

namespace PerfectBuild\Runes\Seals;

class Health extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Health');						
		$this->basic_effects_arr['health'] = 8.0;		
	}
}