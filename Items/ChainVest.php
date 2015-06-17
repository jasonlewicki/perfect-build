<?php 

namespace PerfectBuild\Items;

class ChainVest extends \PerfectBuild\Items\Item{
	
	// Constructor
	public function __construct() {		
		parent::__construct("Chain Vest");	
		$this->cost = 750;	
		$this->sell_value = 525; //TODO: This is wrong
		$this->basic_effects_arr['armor'] = 40;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}