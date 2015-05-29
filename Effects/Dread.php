<?php 

namespace PerfectBuild\Effects;

class Dread extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Dread");	
		
		$this->duration = $option_arr['duration'];
		$this->basic_effects_arr['self_magic_resistance_reduction_flat'] = 0;
		$this->unique = true;
		
	}	
	
	public function tick($tick_rate){
		$effect_arr = Array();
		
		// Do Ability related effects
		/*
		if ($this->time_elapsed % ($tick_rate*$this->interval) == 0){
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