<?php 

namespace PerfectBuild\Runes\Quintessences;

class Armor extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Armor');						
		$this->basic_effects_arr['armor'] = 4.26;		
	}
}