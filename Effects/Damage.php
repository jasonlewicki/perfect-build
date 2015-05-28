<?php 

namespace PerfectBuild\Effects;

class Damage extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($delay, $damage) {		
		parent::__construct("Damage");			
		
		$this->duration = 0.0;
		$this->basic_effects_arr['damage'] = $option_arr['value'];
		$this->unique = false;
	}
}