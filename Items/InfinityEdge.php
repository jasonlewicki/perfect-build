<?php 

namespace PerfectBuild\Items;

class infinityEdge extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Infinity Edge");	
		$this->cost = 3800;	
		$this->sell_value = 2660;	
		$this->basic_effects_arr['attack_damage'] = 80;
		$this->basic_effects_arr['critical_chance_percent'] = 0.20;
		$this->effects_arr[] = new \PerfectBuild\Effects\InfinityEdge();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}