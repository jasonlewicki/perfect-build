<?php 

namespace PerfectBuild\Runes\Quintessences;

class CriticalDamage extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Critical Damage');						
		$this->basic_effects_arr['critical_damage_percent'] = 0.0446;		
	}
}