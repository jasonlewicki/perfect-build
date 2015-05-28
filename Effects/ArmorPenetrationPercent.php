<?php 

namespace PerfectBuild\Effects;

class ArmorPenetrationPercent extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Armor Penetration Percent");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['armor_penetration_percent'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}