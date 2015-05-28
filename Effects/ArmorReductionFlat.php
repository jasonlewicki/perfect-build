<?php 

namespace PerfectBuild\Effects;

class ArmorReductionFlat extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Armor Reduction Flat");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['armor_reduction_flat'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}