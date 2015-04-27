<?php

namespace PerfectBuild\Effects;

Class Effects{
	
	protected $name;
	protected $duration;
		
	public function __construct($name) {
		$this->name = $name;
	}
	
	abstract protected function tick();
	
}
