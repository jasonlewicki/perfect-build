<?php 

namespace PerfectBuild\Monsters;

class MurkWolf extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
				
		$this->level 			= $level;
		$this->gold 			= 16;
		$this->experience 		= 45;
		$this->health 			= 420 + ($level - 1) * 25;
		$this->attack_damage 	= 16 + ($level - 1) * 3;
		$this->attack_speed 	= 0.625;
		$this->armor 			= 6;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 443;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}