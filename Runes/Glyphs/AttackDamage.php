<?php 

namespace PerfectBuild\Runes\Glyphs;

class AttackDamage extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Attack Damage');						
		$this->basic_effects_arr['attack_damage'] = 0.28;		
	}
}