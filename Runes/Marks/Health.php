<?php 

namespace PerfectBuild\Runes\Marks;

class Health extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Health');						
		$this->basic_effects_arr['health'] = 3.47;		
	}
}