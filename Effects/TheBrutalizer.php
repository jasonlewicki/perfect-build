<?php 

namespace PerfectBuild\Effects;

class TheBrutalizer extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("The Brutalizer");	
		
		$this->duration = false;
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.10;
		$this->basic_effects_arr['armor_penetration_flat'] = 10;
		$this->unique = true;
	}	
	
}