<?php 

namespace PerfectBuild\Runes\Glyphs;

class Mana extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Mana');						
		$this->basic_effects_arr['mana'] = 11.25;				
	}
}