<?php 

namespace PerfectBuild\Runes\Quintessences;

class Experience extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Experience');						
		$this->basic_effects_arr['experience'] = 0.02;		
	}
}