<?php 

namespace PerfectBuild\Items;

class BootsOfMobility extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Boots of Mobility");	
		$this->cost = 800;	
		$this->sell_value = 560;	
		$this->effects_arr[] = new \PerfectBuild\Effects\EnchancedMovement(Array('movement_speed_flat'=>60));
		$this->effects_arr[] = new \PerfectBuild\Effects\BootsOfMobility();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}