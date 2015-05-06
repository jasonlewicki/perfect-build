<?php 

namespace PerfectBuild\Effects;

class Dread extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Drain");	
		
		$this->duration = $option_arr['duration'];
		
	}	
	
	public function tick($tick_rate){
		$effect_arr = Array();
		
		// Do Ability related effects
		/*
		$divide = $this->duration/$this->interval;
		if( substr($divide,strpos($divide, '.') + 1)){
			$caster_stats = $this->caster_obj->stats();
			$damage = $this->damage_arr[$this->level] + $caster_stats['ability_power'] * $this->ap_ratio;
			
			$this->receiver_obj->addEffect('Dread', Array('duration' => 2.5));		
			$effect_arr['damage_arr'] = $this->receiver_obj->receiveDamage($damage, 'magic', $caster_stats);
			
			// Need to heal still			
		}	
		*/
		
		return array_merge($effect_arr, parent::tick($tick_rate));
			
	}
	
}