<?php 

namespace PerfectBuild\Items;

class BlastingWand extends \PerfectBuild\Items\Item{
			
	// Constructor
	public function __construct() {		
		parent::__construct("Blasting Wand");
		$this->cost = 860;		
		$this->sell_value = 602;	
		$this->basic_effects_arr['ability_power'] = 40.0;	
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}