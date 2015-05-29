<?php 

namespace PerfectBuild\Runes\Glyphs;

class ManaRegeneration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Mana Regeneration');						
		$this->basic_effects_arr['mana_regeneration_per_5'] = 0.33;				
	}
}