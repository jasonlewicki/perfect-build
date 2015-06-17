<?php 

namespace PerfectBuild\Items;

class BootsOfSwiftness extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Boots of Swiftness");	
		$this->cost = 1000;	
		$this->sell_value = 700;	
		$this->effects_arr[] = new \PerfectBuild\Effects\EnchancedMovement(Array('movement_speed_flat'=>60));
		$this->effects_arr[] = new \PerfectBuild\Effects\SlowResist();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}