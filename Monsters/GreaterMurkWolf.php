<?php 

namespace PerfectBuild\Monsters;

class GreaterMurkWolf extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 53;
		$this->experience 		= 213;
		$this->health 			= 1320 + ($level - 1) * 25;
		$this->attack_damage 	= 42 + ($level - 1) * 3;
		$this->attack_speed 	= 0.625;
		$this->armor 			= 9;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 443;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}