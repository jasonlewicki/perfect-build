<?php

namespace PerfectBuild\Effects;

abstract Class Effect{
	
	protected $name;
	protected $duration;
	protected $value;
		
	public function __construct($name) {
		$this->name = $name;
	}
		
	public function name() {
		return $this->name;
	}	
		
	public function value() {
		return $this->value;
	}
	
	public function tick($tick_rate){
		$this->duration -= (1/$tick_rate);
		if($this->duration <= 0.0){
			return Array('expire' => true);
		}
		return Array('expire' => false);
	}
	
}
