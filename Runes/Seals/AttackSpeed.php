<?php 

namespace PerfectBuild\Runes\Seals;

class AttackSpeed extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Attack Speed');						
		$this->basic_effects_arr['attack_speed_percent'] = 0.76;		
	}
}