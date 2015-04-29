<?php 

namespace PerfectBuild\Spells;

class Drain extends \PerfectBuild\Spells\Spell{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Drain");
		$this->max_ranks(5);
		$this->range_arr(650,650,650,650,650);			
	}
	
	public function cast($caster_obj, $receiver_obj){
		
		// TODO: Need checks for mana availability and range
		
		$caster_obj->addEffect('Disable', Array('duration' => 5));
		$receiver_obj->addEffect('Dread', Array('duration' => 5));
		$receiver_obj->addEffect('Drain', Array('level' => $this->level));
	}
}