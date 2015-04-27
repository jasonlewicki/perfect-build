<?php 

namespace PerfectBuild\Effects;

class Disable extends \PerfectBuild\Effects\Effects{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Disable");	
		
		$this->duration = $option_arr['duration'];
				
	}	
	
	public function tick($tick_rate){
		$duration -= $tick_rate;
		if($duration <= 0.0){
			return Array('expire' => true);
		}
		return Array('expire' => false);
	}	
	
}