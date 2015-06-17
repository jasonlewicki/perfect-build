<?php 

namespace PerfectBuild\Items;

class ClothArmor extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Cloth Armor");
		$this->cost = 300;	
		$this->sell_value = 210;	
		$this->basic_effects_arr['armor'] = 15.0;			
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
	
}