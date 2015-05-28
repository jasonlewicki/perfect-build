<?php 

namespace PerfectBuild\Runes\Seals;

class MagicResist extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Magic Resist');						
		$this->basic_effects_arr['magic_resistance'] = 0.74;				
	}
}