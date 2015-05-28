<?php 

namespace PerfectBuild\Effects;

class MagicResistancePenetrationPercent extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Magic Resistance Penetration Percent");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['magic_resistance_penetration_percent'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}