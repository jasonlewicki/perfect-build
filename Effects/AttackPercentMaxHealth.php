<?php 

namespace PerfectBuild\Effects;

class AttackPercentMaxHealth extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Attack Percent Max Health");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['armor_percent_max_health'] = $option_arr['value'];
		$this->unique = false;
		
	}	
	
}