<?php 

namespace PerfectBuild\Monsters;

class Raptor extends \PerfectBuild\Monsters\Monsters{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 9;
		$this->experience 		= 30;
		$this->health 			= 250 + ($level - 1) * 25;
		$this->attack_damage 	= 16 + ($level - 1) * 3;
		$this->attack_speed 	= 0.67;
		$this->armor 			= 5;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 350;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}