<?php 

namespace PerfectBuild\Effects;

class BootsOfMobility extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Boots of Mobility");	
		
		$this->duration = false;
		$this->unique = true;
	}	
	
	//TODO: If out of combat for 5 seconds, increase movement speed by 80
	
}