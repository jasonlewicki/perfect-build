<?php 

namespace PerfectBuild\Effects;

class BerserkersGreaves extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Berserker's Greaves");	
		
		$this->duration = false;
		$this->basic_effects_arr['attack_speed_percent'] = 0.25;
		$this->unique = true;
	}	
	
}