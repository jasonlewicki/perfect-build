<?php 

namespace PerfectBuild\Runes\Glyphs;

class EnergyScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Energy Scaling');						
		$this->basic_effects_arr['energy_scaling'] = 0.161;		
	}
}