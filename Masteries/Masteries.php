<?php

namespace PerfectBuild\Masteries;

abstract Class Masteries{
	
	protected $name;
		
	public function __construct($name) {
		$this->name = $name;
	}
	
}
