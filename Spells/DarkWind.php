<?php 

namespace PerfectBuild\Spells;

class DarkWind extends \PerfectBuild\Spells\Spell{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Dark Wind");			
	}
	
	public function cast($caster_obj, $receiver_obj){
		parent::cast($caster_obj, $receiver_obj);
		
	}
}