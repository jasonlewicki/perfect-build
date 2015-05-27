<?php 

namespace PerfectBuild\Effects;

class Disable extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Disable");	
		$this->duration = $option_arr['duration'];
	}	
	
}