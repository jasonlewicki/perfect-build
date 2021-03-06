<?php 

namespace PerfectBuild\Effects;

class AbyssalScepter extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
	protected $range;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Abyssal Scepter");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance_reduction_flat'] = 20.0;
		$this->unique = true;
		$this->range = 700;
	}	
	
}