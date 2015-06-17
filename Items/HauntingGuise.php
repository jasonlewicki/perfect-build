<?php 

namespace PerfectBuild\Items;

class HauntingGuise extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Haunting Guise");	
		$this->cost = 1485;	
		$this->sell_value = 1040;	
		$this->basic_effects_arr['ability_power'] = 25;
		$this->basic_effects_arr['health'] = 200;
		$this->effects_arr[] = new \PerfectBuild\Effects\EyesOfPain();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}