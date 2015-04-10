<?php 

namespace PerfectBuild\Monsters;

class Sentry extends \PerfectBuild\Monsters\Monsters{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 20;
		$this->experience 		= 75;
		$this->health 			= 400 + ($level - 1) * 10;
		$this->attack_damage 	= 12 + ($level - 1) * 3;
		$this->attack_speed 	= 0.625;
		$this->armor 			= 8;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 330;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}