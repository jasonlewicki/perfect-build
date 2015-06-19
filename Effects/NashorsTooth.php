<?php 

namespace PerfectBuild\Effects;

class NashorsTooth extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Nashor's Tooth");	
		
		$this->duration = false;
		$this->basic_effects_arr['cooldown_reduction'] = 0.20;		
		
		//TODO: UNIQUE: Basic attacks deal 15 (+ 15% AP) bonus magic damage on hit
		$this->unique = true;
	}	
	
}