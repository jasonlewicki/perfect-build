<?php 

namespace PerfectBuild\Effects;

class AbyssalScepeter extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Abyssal Scepter");	
		
		$this->duration = false;
		$this->unique = true;
		
		//Passive	UNIQUE - MANA FONT: Restores 2% of missing mana every 5 seconds.
		//UNIQUE: Restores 30% of your max mana on kill or assist.
		
	}	
	
}