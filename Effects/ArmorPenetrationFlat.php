<?php 

namespace PerfectBuild\Effects;

class ArmorPenetrationFlat extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Armor Penetration Flat");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['armor_penetration_flat'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}