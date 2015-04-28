<?php 

namespace PerfectBuild\Minions;

class CasterMinion extends \PerfectBuild\Minions\Minion{
		
	// Constructor
	public function __construct($second) {		
		parent::__construct();			
		
		$this->gold 			= 16.8 + floor($second / 90) * 0.2;
		$this->experience 		= 29;
		$this->health 			= ($second / 60 >= 3) ? 290 + (floor(($second - 90) / 90) * 11) : 290;
		$this->attack_damage 	= 23 + floor($second / 90) * 3;
		$this->attack_speed 	= 0.670;
		$this->armor 			= 0;
		$this->magic_resistance = 0;
		
	}
}