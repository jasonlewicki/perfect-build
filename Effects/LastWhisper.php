<?php 

namespace PerfectBuild\Effects;

class LastWhisper extends \PerfectBuild\Effects\Effect{
	
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Last Whisper");	
		
		$this->duration = false;
		$this->basic_effects_arr['armor_penetration_percent'] = 0.35;
		$this->unique = true;
	}	
	
}