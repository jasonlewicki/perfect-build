<?php 

namespace PerfectBuild\Effects;

class SorcerersShoes extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Sorcerer's Shoes");	
		
		$this->duration = false;
		$this->basic_effects_arr['magic_resistance_penetration_flat'] = 0.15;
		$this->unique = true;
	}	
	
}