<?php 

namespace PerfectBuild\Effects;

class Favor extends \PerfectBuild\Effects\Effect{
	
	protected $range;
			
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Abyssal Scepter");	
		
		$this->duration = false;
		//$this->basic_effects_arr['magic_resistance_reduction_flat'] = 20.0;
		$this->unique = true;
		$this->range = 1400;
		
		//Passive	UNIQUE - FAVOR: Being near a minion death without granting the killing blow grants 3 gold and heals for 5 health (1400 range).
		
	}	
	
}