<?php 

namespace PerfectBuild\Effects;

class Disable extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Disable");	
		
		$this->duration = 5;
		$this->interval = .5;		
		
		
		// Where to put this?
		//MAGIC DAMAGE PER SECOND: 60 / 90 / 120 / 150 / 180 (+ 45% AP)
		//MAX MAGIC DAMAGE: 300 / 450 / 600 / 750 / 900 (+ 225% AP)
		//HEAL FROM DAMAGE RATIO: 60 / 65 / 70 / 75 / 80%
		
	}	
	
}