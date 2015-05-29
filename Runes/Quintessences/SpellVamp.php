<?php 

namespace PerfectBuild\Runes\Quintessences;

class SpellVamp extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Spell Vamp');						
		$this->basic_effects_arr['spell_vamp_percent'] = 0.02;				
	}
}