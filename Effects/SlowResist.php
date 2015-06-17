<?php 

namespace PerfectBuild\Effects;

class SlowResist extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Slow Resist");	
		
		$this->duration = false;
		$this->basic_effects_arr['slow_resist_percent'] = .30;
		$this->unique = true;
	}	
	
}