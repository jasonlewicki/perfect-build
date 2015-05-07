<?php

namespace PerfectBuild\Effects;

abstract Class Effect{
	
	protected $name;
	protected $time_elapsed;
	protected $duration;
	protected $value;
		
	public function __construct($name) {
		$this->name = $name;
		$this->time_elapsed = 0;
	}
		
	public function name() {
		return $this->name;
	}	
		
	public function value() {
		return $this->value;
	}
	
	public function tick($tick_rate){
		$this->time_elapsed++;
		if(($this->duration*$tick_rate) - $this->time_elapsed < 0.0){
			return Array('expire' => true);
		}
		return Array('expire' => false);
	}
	
}
