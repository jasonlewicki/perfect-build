<?php 

namespace PerfectBuild\Minions;

class SuperMinion extends \PerfectBuild\Minions\Minions{
		
	// Constructor
	public function __construct($second) {		
		parent::__construct();			
		
		$this->gold 			= 40.0 + floor($second / 180) * 1.0;
		$this->experience 		= 97;
		$this->health 			= ($second / 60 >= 3) ? 1500 + (floor(($second - 180) / 180) * 200) : 1500;
		$this->attack_damage 	= 180 + floor($second / 180) * 10;
		$this->attack_speed 	= 0.694;
		$this->armor 			= 0;
		$this->magic_resistance = 0;
		
	}
}