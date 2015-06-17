<?php 

namespace PerfectBuild\Items;

class SapphireCrystal extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Sapphire Crystal");	
		$this->cost = 400;	
		$this->sell_value = 280;	
		$this->basic_effects_arr['mana'] = 200;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}