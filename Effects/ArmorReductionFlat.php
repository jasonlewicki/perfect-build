<?php 

namespace PerfectBuild\Effects;

class ArmorReductionPercent extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Armor Reduction Percent");	
		
		$this->duration = $option_arr['duration'];
		$this->interval = NULL;
		$this->value = $option_arr['value'];
		
	}	
	
}