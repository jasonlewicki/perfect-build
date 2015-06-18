<?php 

namespace PerfectBuild\Effects;

class GlacialShroud extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Glacial Shroud");	
		
		$this->duration = false;
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.10;
		$this->unique = true;
	}	
	
}