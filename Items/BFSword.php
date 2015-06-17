<?php 

namespace PerfectBuild\Items;

class BFSword extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("B.F. Sword");	
		$this->cost = 1550;	
		$this->sell_value = 1085;	
		$this->basic_effects_arr['attack_damage'] = 50;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}