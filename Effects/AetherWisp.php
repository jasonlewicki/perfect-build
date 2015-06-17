<?php 

namespace PerfectBuild\Effects;

class AetherWisp extends \PerfectBuild\Effects\Effect{
			
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Aether Wisp");	
		
		$this->duration = false;
		$this->basic_effects_arr['movement_speed'] = 0.05;
		$this->unique = true;
		$this->range = 700;
	}	
	
}