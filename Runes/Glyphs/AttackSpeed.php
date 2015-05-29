<?php 

namespace PerfectBuild\Runes\Glyphs;

class AttackSpeed extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Attack Speed');						
		$this->basic_effects_arr['attack_speed_percent'] = 0.0064;		
	}
}