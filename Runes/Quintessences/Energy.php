<?php 

namespace PerfectBuild\Runes\Quintessences;

class Energy extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Energy');						
		$this->basic_effects_arr['energy'] = 2.2;		
	}
}