<?php 

namespace PerfectBuild\Items;

class IonianBootsOfLucidity extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Ionian Boots of Lucidity");	
		$this->cost = 1000;	
		$this->sell_value = 700;	
		$this->effects_arr[] = new \PerfectBuild\Effects\EnchancedMovement(Array('movement_speed_flat'=>45));
		$this->effects_arr[] = new \PerfectBuild\Effects\IonianBootsOfLucidity();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}