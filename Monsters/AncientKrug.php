<?php 

namespace PerfectBuild\Monsters;

class AncientKrug extends \PerfectBuild\Monsters\Monster{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 60;
		$this->experience 		= 225;
		$this->health 			= 1440 + ($level - 1) * 125;
		$this->attack_damage 	= 73 + ($level - 1) * 3;
		$this->attack_speed 	= 0.613;
		$this->armor 			= 12;
		$this->magic_resistance = -10;
		$this->movement_speed 	= 285;
		$this->spawn_time 		= 115;
		$this->respawn_time 	= 100;	
		
	}
}