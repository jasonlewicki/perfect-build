<?php 

namespace PerfectBuild\Monsters;

class Gromp extends \PerfectBuild\Monsters\Monsters{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 62;
		$this->experience 		= 300;
		$this->health 			= 1600 + ($level - 1) * 125;
		$this->attack_damage 	= 83 + ($level - 1) * 3;
		$this->attack_speed 	= 0.63;
		$this->armor 			= 15;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 330;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}