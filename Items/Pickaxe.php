<?php 

namespace PerfectBuild\Items;

class Pickaxe extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Pickaxe");	
		$this->cost = 875;	
		$this->sell_value = 613;	
		$this->basic_effects_arr['attack_damage'] = 25;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}