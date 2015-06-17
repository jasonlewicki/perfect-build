<?php 

namespace PerfectBuild\Items;

class AncientCoin extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Ancient Coin");	
		$this->cost = 365;	
		$this->sell_value = 146;	
		$this->basic_effects_arr['mana_regeneration_per_5_percent'] = 0.25;
		$this->effects_arr[] = new \PerfectBuild\Effects\Favor();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}