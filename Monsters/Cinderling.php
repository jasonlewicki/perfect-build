<?php 

namespace PerfectBuild\Monsters;

class Cinderling extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 20;
		$this->experience 		= 75;
		$this->health 			= 400 + ($level - 1) * 25;
		$this->attack_damage 	= 12 + ($level - 1) * 3;
		$this->attack_speed 	= 0.599;
		$this->armor 			= 12;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 330;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 300;	
		
	}
}