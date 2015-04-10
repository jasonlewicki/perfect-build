<?php 

namespace PerfectBuild\Monsters;

class Krug extends \PerfectBuild\Monsters\Monsters{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 14;
		$this->experience 		= 75;
		$this->health 			= 540 + ($level - 1) * 10;
		$this->attack_damage 	= 35 + ($level - 1) * 3;
		$this->attack_speed 	= 0.613;
		$this->armor 			= 12;
		$this->magic_resistance = -10;
		$this->movement_speed 	= 285;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}