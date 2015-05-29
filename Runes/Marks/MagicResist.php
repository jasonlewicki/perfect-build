<?php 

namespace PerfectBuild\Runes\Marks;

class MagicResist extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Magic Resist');						
		$this->basic_effects_arr['magic_resistance'] = 0.77;				
	}
}