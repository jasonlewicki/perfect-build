<?php 

namespace PerfectBuild\Runes\Quintessences;

class Health extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health');						
		$this->basic_effects_arr['health'] = 26.0;		
	}
}