<?php 

namespace PerfectBuild\Monsters;

class BaronNashor extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level, $minute) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 300;
		$this->experience 		= 1400;
		$this->health 			= 6400 + ($minute - 1) * 180;
		$this->attack_damage 	= (240 + ($minute - 1) * 8 > 310) ? 310 : 240 + ($minute - 1) * 8;
		$this->attack_speed 	= 0.75;
		$this->armor 			= 120;
		$this->magic_resistance = 70;
		$this->movement_speed 	= 300;
		$this->spawn_time 		= 1200;
		$this->respawn_time 	= 420;	
		
	}
}