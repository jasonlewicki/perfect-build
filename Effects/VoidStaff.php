<?php 

namespace PerfectBuild\Effects;

class VoidStaff extends \PerfectBuild\Effects\Effect{
	
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Void Staff");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance_penetration_percent'] = 0.35;
		$this->unique = true;
	}	
	
}