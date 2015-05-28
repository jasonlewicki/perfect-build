<?php 

namespace PerfectBuild\Effects;

class ArmorReductionPercent extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Armor Reduction Percent");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['armor_reduction_percent'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}