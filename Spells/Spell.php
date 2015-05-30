<?php

namespace PerfectBuild\Spells;

abstract Class Spell{
	
	protected $name;
	protected $max_ranks;
	protected $level;
	protected $range_arr;
	protected $cooldown_arr;
	protected $cooldown_time_elapsed;
	protected $cooldown_duration;
	protected $on_cooldown;
	
	/*	
	protected $is_channeled;
	protected $has_passive;
	protected $max_ranks;
	protected $ap_ratio;
	protected $ad_ratio;
	protected $bonus_ad_ratio;
	protected $bonus_health_ratio;
	protected $duration;
	*/
	
	protected $effects_arr;
		
	public function __construct($name) {
		$this->name = $name;
		$this->on_cooldown = false;
	}
	
	public function cast($caster_obj, $receiver_obj){
		$this->on_cooldown = true;
		$stats_arr = $caster_obj->stats();	
		$this->cooldown_duration = $this->cooldown_arr[$this->level] * (1 - $stats_arr['cooldown_reduction']);		
	}
	
	public function level() {
		if($this->level == $this->max_ranks){
			throw new \Exception('Max Rank Exception');
		}
		
		$this->level++;
		return;
	}
	
	// Is the spell available to be cast?
	public function free() {
		return !($this->on_cooldown);
	}
	
	public function tick($tick_rate) {
		if($this->on_cooldown){
			$this->cooldown_time_elapsed++;
			if(($this->cooldown_duration*$tick_rate) - $this->cooldown_time_elapsed < 0.0){
				$this->on_cooldown = false;
			}		
		}
	}
	
}
