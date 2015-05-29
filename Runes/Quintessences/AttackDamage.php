<?php 

namespace PerfectBuild\Runes\Quintessences;

class AttackDamage extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Attack Damage');						
		$this->basic_effects_arr['attack_damage'] = 2.25;		
	}
}