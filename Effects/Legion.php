<?php 

namespace PerfectBuild\Effects;

class Legion extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
	protected $range;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Legion");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance'] = 20.0;
		$this->basic_effects_arr['health_regeneration_percent'] = 0.20;
		$this->unique = true;
		$this->range = 1100;
	}	
	
}