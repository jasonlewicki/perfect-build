<?php

namespace PerfectBuild\Items;

abstract Class Item{
	
	protected $name;	
	protected $effects_arr;	
	protected $basic_effects_arr;
	protected $cost;
	protected $sell_value;
	protected $cooldown;
	protected $cooldown_time_elapsed;
	protected $cooldown_duration;
	protected $on_cooldown;
		
	public function __construct($name) {
		$this->name = $name;	
		$this->effects_arr = Array();
		$this->basic_effects_arr = Array();		
		$this->on_cooldown = false;
	}
	
	public function activate($caster_obj, $mob_obj){
		$this->on_cooldown = true;
		$stats_arr = $caster_obj->stats();	
		$this->cooldown_duration = $this->cooldown * (1 - $stats_arr['item_cooldown_reduction']);	
	}
		
	public function name() {
		return $this->name;
	}	
	
	public function cost() {
		return $this->cost;
	}	
	
	public function basicEffectsArr() {
		return $this->basic_effects_arr;
	}
	
	public function effectsArr() {
		return $this->basic_effects_arr;
	}
	
	public function tick($tick_rate){
		if($this->on_cooldown){
			$this->cooldown_time_elapsed++;
			if(($this->cooldown_duration*$tick_rate) - $this->cooldown_time_elapsed < 0.0){
				$this->on_cooldown = false;
			}		
		}
	}
	
}
