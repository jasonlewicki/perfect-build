<?php 

namespace PerfectBuild\Effects;

class MagicResistanceReductionFlat extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Magic Resistance Reduction Flat");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['magic_resistance_reduction_flat'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}