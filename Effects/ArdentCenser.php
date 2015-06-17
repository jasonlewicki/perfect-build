<?php 

namespace PerfectBuild\Effects;

class ArdentCenser extends \PerfectBuild\Effects\Effect{
			
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Ardent Censer");	
		
		$this->duration = false;
		$this->basic_effects_arr['bonus_movement_speed_percent'] = 0.08;
		$this->unique = true;
		
		//UNIQUE: Your heals and shields on champions grant them 15% attack speed for 6 seconds and their attacks deals 30 magic damage on-hit. This does not include regeneration effects or effects on yourself.
	}	
	
}