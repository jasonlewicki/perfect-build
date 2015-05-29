<?php 

namespace PerfectBuild\Runes\Seals;

class EnergyRegeneration extends \PerfectBuild\Runes\Rune{
		
	// Constructor
	public function __construct() {		
		parent::__construct('Energy Regeneration');						
		$this->basic_effects_arr['energy_regeneration_per_5'] = 0.63;		
	}
}