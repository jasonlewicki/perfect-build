<?php 

namespace PerfectBuild\Spells;

class Drain extends \PerfectBuild\Spells\Spell{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Drain");
		$this->max_ranks = 5;
		$this->range_arr = Array(650,650,650,650,650);	
		$this->cooldown_arr = Array(10,9,8,7,6);			
	}
	
	public function cast($caster_obj, $receiver_obj){
		
		// TODO: Need checks for mana availability and range
		parent::cast($caster_obj, $receiver_obj);
		
		$caster_obj->stats();
		
		$caster_obj->addEffect('Disable', Array('duration' => 5));
		$receiver_obj->addEffect('Drain', Array('level' => $this->level, 'caster_obj' => $caster_obj, 'receiver_obj' => $receiver_obj));
	}
}