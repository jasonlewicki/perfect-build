<?php

namespace PerfectBuild\Masteries;

abstract Class Mastery{
	
	protected $name;
		
	public function __construct($name) {
		$this->name = $name;
	}
	
}
