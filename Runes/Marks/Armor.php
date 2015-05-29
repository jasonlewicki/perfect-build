<?php 

namespace PerfectBuild\Runes\Marks;

class Armor extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Armor');						
		$this->basic_effects_arr['armor'] = 0.91;		
	}
}