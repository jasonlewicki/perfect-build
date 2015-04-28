<?php

namespace PerfectBuild\Summoners;

abstract Class Summoners{
	
	protected $name;
		
	public function __construct($name) {
		$this->name = $name;
	}
	
}
