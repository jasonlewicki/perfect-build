<?php

namespace PerfectBuild\Spells;

abstract Class Spells{
	
	protected $name;
	protected $level;
	protected $is_channeled;
	protected $has_passive;
	protected $max_ranks;
	protected $ap_ratio;
	protected $ad_ratio;
	protected $bonus_ad_ratio;
	protected $bonus_health_ratio;
	protected $duration;	
		
	public function __construct($name) {
		$this->name = $name;
	}
	
	public function level() {
		if($this->level == $this->max_ranks){
			throw new Exception('Max Rank Exception');
		}
		
		$this->level++;
		return;
	}
	
}
