<?php

namespace PerfectBuild\Summoners;

abstract Class Summoner{
	
	protected $name;
		
	public function __construct($name) {
		$this->name = $name;
	}
	
}
