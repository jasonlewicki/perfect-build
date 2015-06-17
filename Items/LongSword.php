<?php 

namespace PerfectBuild\Items;

class LongSword extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Long Sword");	
		$this->cost = 360;	
		$this->sell_value = 280;	
		$this->basic_effects_arr['attack_damage'] = 10;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}