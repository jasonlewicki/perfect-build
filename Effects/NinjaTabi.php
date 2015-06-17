<?php 

namespace PerfectBuild\Effects;

class NinjaTabi extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Ninja Tabi");	
		
		$this->duration = false;
		$this->basic_effects_arr['armor'] = 25;		
		$this->basic_effects_arr['block_basic_attack_percent'] = 0.10;
		$this->unique = true;
	}	
	
}