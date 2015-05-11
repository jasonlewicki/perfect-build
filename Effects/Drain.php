<?php 

namespace PerfectBuild\Effects;

class Drain extends \PerfectBuild\Effects\Effect{
	
	protected $interval;
	protected $caster_obj;
	protected $receiver_obj;
	protected $level;
	protected $damage_arr;
	protected $heal_arr;
	protected $ap_ratio;
		
	// Constructor
	public function __construct($option_arr) {		
		parent::__construct("Drain");	
		
		$this->duration = 5;
		$this->interval = 0.5;
		
		$this->level = $option_arr['level'] - 1;
		$this->caster_obj = $option_arr['caster_obj'];
		$this->receiver_obj = $option_arr['receiver_obj'];
		
		$this->ap_ratio = .45;
		$this->damage_arr = Array(60,90,120,150,180);
		$this->heal_arr = Array(0.60,0.65,0.70,0.75,0.80);
		
		$this->unique = false;
		
	}	
	
	public function tick($tick_rate){
		$effect_arr = Array();
		// Do Ability related effects
		if ($this->time_elapsed % ($tick_rate*$this->interval) == 0){
			$caster_stats = $this->caster_obj->stats();
			$damage = ($this->damage_arr[$this->level] + $caster_stats['ability_power'] * $this->ap_ratio) * $this->interval;
			$this->receiver_obj->addEffect('Dread', Array('duration' => 2.5));	
			$effect_arr['damage_arr'] = $this->receiver_obj->receiveDamage($damage, 'magic', $caster_stats);
			
			// Need to heal still			
		}	
		
		return array_merge($effect_arr, parent::tick($tick_rate));
			
	}
	
}