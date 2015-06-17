<?php 

namespace PerfectBuild\Items;

class Zeal extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Zeal");	
		$this->cost = 1100;	
		$this->sell_value = 770;	
		$this->basic_effects_arr['attack_speed_percent'] = 0.20;
		$this->basic_effects_arr['critical_chance_percent'] = 0.10;
		$this->basic_effects_arr['movement_speed_percent'] = 0.05;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}