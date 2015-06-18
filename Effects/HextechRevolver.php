<?php 

namespace PerfectBuild\Effects;

class HextechRevolver extends \PerfectBuild\Effects\Effect{
	
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Hextech Revolver");	
		
		$this->duration = false;
		$this->basic_effects_arr['spell_vamp_percent'] = 0.12;
		$this->unique = true;
	}	
	
}