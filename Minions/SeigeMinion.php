<?php 

namespace PerfectBuild\Minions;

class SiegeMinion extends \PerfectBuild\Minions\Minions{
		
	// Constructor
	public function __construct($second) {		
		parent::__construct();			
		
		$this->gold 			= 40.0 + floor($second / 90) * 0.5;
		$this->experience 		= 92;
		$this->health 			= ($second / 60 >= 3) ? 805 + (floor(($second - 90) / 90) * 23) : 805;
		$this->attack_damage 	= 39.5 + floor($second / 90) * 1.5;
		$this->attack_speed 	= 1.0;
		$this->armor 			= 0;
		$this->magic_resistance = 0;
		
	}
}