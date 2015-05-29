<?php 

namespace PerfectBuild\Runes\Marks;

class ArmorPenetration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Armor Penetration');						
		$this->basic_effects_arr['armor_penetration'] = 1.28;		
	}
}