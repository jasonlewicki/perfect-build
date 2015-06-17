<?php 

namespace PerfectBuild\Effects;

class InfinityEdge extends \PerfectBuild\Effects\Effect{
			
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Infinity Edge");	
		
		$this->duration = false;
		$this->basic_effects_arr['critical_damage_percent'] = 0.50;
		$this->unique = true;
	}	
	
}