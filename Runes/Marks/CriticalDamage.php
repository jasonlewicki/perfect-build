<?php 

namespace PerfectBuild\Runes\Marks;

class CriticalDamage extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Critical Damage');						
		$this->basic_effects_arr['critical_damage_percent'] = 2.23;		
	}
}