<?php 

namespace PerfectBuild\Effects;

class MercuryTreads extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Mercury Treads");	
		
		$this->duration = false;		
		$this->basic_effects_arr['tenacity'] = 0.35;
		$this->unique = true;
	}	
	
}