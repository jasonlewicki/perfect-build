<?php 

namespace PerfectBuild\Champions;

class SuperMinion extends \PerfectBuild\Champions\Champions{
		
	// Constructor
	public function __construct($level) {		
		parent::__construct();			
			
		// After implementation of masteries...
		//$this->gold						= 0;
		$this->level					= $level;
		$this->experience				= 0;
		$this->base_health				= 524;
		$this->health_per_level			= 80;
		$this->base_health_regen		= 5.6;
		$this->health_regen_per_level	= 0.6;
		$this->base_mana				= 350;
		$this->mana_per_level			= 59;
		$this->base_mana_regen			= 6.0;
		$this->mana_regen_per_level		= 0.8;
		$this->base_attack_damage		= 48;
		$this->attack_damage_per_level	= 2.6470588235294117647058823529412;
		$this->base_attack_speed		= 0.625;
		$this->base_armor				= 20.9;
		$this->armor_per_level			= 3.5;
		$this->base_magic_resist		= 30;
		$this->base_movement_speed		= 335;
		
	}
}