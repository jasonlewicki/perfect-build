<?php 

namespace PerfectBuild\Runes\Seals;

class AttackDamageScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Attack Damage Scaling');						
		$this->basic_effects_arr['attack_damage_scaling'] = 0.06;		
	}
}