<?php

namespace PerfectBuild\Effects;

abstract Class Effect{
	
	protected $name;
	protected $time_elapsed;
	protected $duration;
	protected $basic_effects_arr;
	protected $unique;
		
	public function __construct($name) {
		$this->name = $name;
		$this->time_elapsed = 0.0;
		$this->basic_effects_arr = Array();
		$this->unique = false;
	}
		
	public function name() {
		return $this->name;
	}	
		
	public function value() {
		return $this->value;
	}
		
	public function basicEffectsArr() {
		return $this->basic_effects_arr;
	}
	
	public function isUnique() {
		return $this->unique;
	}
	
	public function tick($tick_rate){
		$this->time_elapsed++;
		if(($this->duration*$tick_rate) - $this->time_elapsed < 0.0){
			return Array('expire' => true);
		}
		return Array('expire' => false);
	}
	
}
