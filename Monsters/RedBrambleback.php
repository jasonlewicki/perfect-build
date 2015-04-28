<?php 

namespace PerfectBuild\Monsters;

class RedBrambleback extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 36;
		$this->experience 		= 150;
		$this->health 			= 2000 + ($level - 1) * 25;
		$this->attack_damage 	= 80 + ($level - 1) * 3;
		$this->attack_speed 	= 0.60;
		$this->armor 			= 20;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 330;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 300;	
		
	}
}