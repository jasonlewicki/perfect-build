<?php 

namespace PerfectBuild\Effects;

class EyesOfPain extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
	protected $range;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Eyes of Pain");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance_penetration_flat'] = 15.0;
		$this->unique = true;
	}	
	
}