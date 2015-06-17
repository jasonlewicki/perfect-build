<?php 

namespace PerfectBuild\Effects;

class IonianBootsOfLucidity extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Ionian Boots of Lucidity");	
		
		$this->duration = false;
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.15;
		$this->unique = true;
	}	
	
}