<?php 

namespace PerfectBuild\Runes\Quintessences;

class Revival extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Revival');						
		$this->basic_effects_arr['time_dead_percent'] = -5.0;				
	}
}