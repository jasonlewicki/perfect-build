<?php 

namespace PerfectBuild\Effects;

class AbyssalScepeter extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
	protected $range;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Magic Resistance Reduction Flat");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance_reduction_flat'] = 20.0;
		$this->unique = true;
		$this->range = 700;
	}	
	
}