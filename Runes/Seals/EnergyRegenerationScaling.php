<?php 

namespace PerfectBuild\Runes\Seals;

class EnergyRegenerationScaling extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct($mob_obj) {		
		parent::__construct('Energy Regeneration Scaling');						
		$this->basic_effects_arr['energy_regeneration_per_5_scaling'] = 0.064;		
	}
}