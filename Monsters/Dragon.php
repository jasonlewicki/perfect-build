<?php 

namespace PerfectBuild\Monsters;

class Dragon extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level, $minute) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 25;
		$this->experience 		= 75;
		$this->health 			= 3500 + ($minute - 1) * 240;
		$this->attack_damage 	= 75 + ($level - 1) * 3;
		$this->attack_speed 	= 0.449;
		$this->armor 			= ($level >= 9) ? 21 + ($level - 9) * 13 : 21;
		$this->magic_resistance = ($level >= 9) ? 30 + ($level - 9) * 5.85 : 30;
		$this->movement_speed 	= 330;
		$this->spawn_time 		= 150;
		$this->respawn_time 	= 360;	
		
	}
}