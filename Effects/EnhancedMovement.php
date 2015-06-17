<?php 

namespace PerfectBuild\Effects;

class EnhancedMovement extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Enhanced Movement");	
		
		$this->duration = false;
		$this->basic_effects_arr['movement_speed_flat'] = $option_arr['movement_speed_flat'];
		$this->unique = true;
	}	
	
}