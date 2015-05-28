<?php 

namespace PerfectBuild\Effects;

class MagicPercentCurrentHealth extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Magic Percent Current Health");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['magic_percent_current_health'] = $option_arr['value'];
		$this->unique = false;
	}	
	
}