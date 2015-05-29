<?php

namespace PerfectBuild\Spells;

abstract Class Spell{
	
	protected $name;
	protected $max_ranks;
	protected $level;
	protected $range_arr;
	protected $cooldown_arr;
	
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
	}
	
	abstract public function cast($caster_obj, $receiver_obj);
	
	public function level() {
		if($this->level == $this->max_ranks){
			throw new \Exception('Max Rank Exception');
		}
		
		$this->level++;
		return;
	}
	
	// Is the spell available to be cast?
	public function free() {
		
	}
	
}
