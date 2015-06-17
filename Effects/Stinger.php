<?php 

namespace PerfectBuild\Effects;

class Stinger extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Stinger");	
		
		$this->duration = false;
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.10;
		$this->unique = true;
	}	
	
}