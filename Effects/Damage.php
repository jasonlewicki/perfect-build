<?php 

namespace PerfectBuild\Effects;

class Damage extends \PerfectBuild\Effects\Effect{
		
	// Constructor
	public function __construct($delay, $damage) {		
		parent::__construct("Damage");			
	}
}