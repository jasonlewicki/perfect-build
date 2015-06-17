<?php 

namespace PerfectBuild\Effects;

class WarmogsArmor extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Warmog's Armor");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance_reduction_flat'] = 20.0;
		$this->unique = true;
		
		//TODO: Unique Passive: You gain health regeneration equal to 1% of your maximum health. Health restore increases to 3% of maximum health if damage hasn't been taken within 8 seconds. 
	}	
}