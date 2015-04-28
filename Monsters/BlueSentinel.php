<?php 

namespace PerfectBuild\Monsters;

class BlueSentinel extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 36;
		$this->experience 		= 150;
		$this->health 			= 2000 + ($level - 1) * 125;
		$this->attack_damage 	= 73 + ($level - 1) * 3;
		$this->attack_speed 	= 0.493;
		$this->armor 			= 20;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 200;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 300;	
		
	}
}