<?php 

namespace PerfectBuild\Minions;

class MeleeMinion extends \PerfectBuild\Minions\Minion{
		
	// Constructor
	public function __construct($second) {		
		parent::__construct();			
		
		$this->gold 			= 19.8 + floor($second / 90) * 0.2;
		$this->experience 		= 59;
		$this->health 			= ($second / 60 >= 3) ? 455 + (floor(($second - 90) / 90) * 15) : 455;
		$this->attack_damage 	= 12 + floor($second / 90) * 0.5;
		$this->attack_speed 	= 1.250;
		$this->armor 			= 0;
		$this->magic_resistance = 0;
		
	}
}