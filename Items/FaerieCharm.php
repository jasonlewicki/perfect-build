<?php 

namespace PerfectBuild\Items;

class FaerieCharm extends \PerfectBuild\Items\Item{
	
	// Constructor
	public function __construct() {		
		parent::__construct("Faerie Charm");	
		$this->cost = 180;	
		$this->sell_value = 126;	
		$this->basic_effects_arr['mana_regeneration_per_5_percent'] = 0.25;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}