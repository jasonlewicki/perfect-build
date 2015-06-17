<?php 

namespace PerfectBuild\Items;

class GiantsBelt extends \PerfectBuild\Items\Item{
	
	// Constructor
	public function __construct() {		
		parent::__construct("Giant's Belt");	
		$this->cost = 1000;	
		$this->sell_value = 700;	
		$this->basic_effects_arr['health'] = 380;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}