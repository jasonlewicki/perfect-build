<?php 

namespace PerfectBuild\Monsters;

class CrimsonRaptor extends \PerfectBuild\Monsters\Monsters{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 60;
		$this->experience 		= 260;
		$this->health 			= 1200 + ($level - 1) * 175;
		$this->attack_damage 	= 45 + ($level - 1) * 3;
		$this->attack_speed 	= 0.67;
		$this->armor 			= 15;
		$this->magic_resistance = 0;
		$this->movement_speed 	= 350;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}