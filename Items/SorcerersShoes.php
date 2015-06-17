<?php 

namespace PerfectBuild\Items;

class SorcerersShoes extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Sorcerer's Shoes");	
		$this->cost = 1100;	
		$this->sell_value = 770;	
		$this->effects_arr[] = new \PerfectBuild\Effects\EnchancedMovement(Array('movement_speed_flat'=>45));
		$this->effects_arr[] = new \PerfectBuild\Effects\SorcerersShoes();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}