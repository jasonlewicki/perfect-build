<?php 

namespace PerfectBuild\Runes\Quintessences;

class ArmorPenetration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Armor Penetration');						
		$this->basic_effects_arr['armor_penetration'] = 2.25;		
	}
}