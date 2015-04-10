<?php 

namespace PerfectBuild\Monsters;

class RiftScuttler extends \PerfectBuild\Monsters\Monsters{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
		
		$this->level 			= $level;
		$this->gold 			= 50;
		$this->experience 		= 75;
		$this->health 			= 800 + ($level - 1) * 25;
		$this->attack_damage 	= 35 + ($level - 1) * 3;
		$this->attack_speed 	= 0.638;
		$this->armor 			= 60;
		$this->magic_resistance = 60;
		$this->movement_speed 	= 155;
		$this->spawn_time 		= 150;
		$this->respawn_time 	= 180;	
		
	}
}