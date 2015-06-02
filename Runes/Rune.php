<?php

namespace PerfectBuild\Runes;

abstract Class Rune{
	
	protected $name;		
	protected $basic_effects_arr;
		
	public function __construct($name) {
		$this->name = $name;		 
		$this->basic_effects_arr = Array();
	}
		
	public function name() {
		return $this->name;
	}
	
	public function basicEffectsArr() {
		return $this->basic_effects_arr;
	}
	
}
