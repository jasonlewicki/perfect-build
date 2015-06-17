<?php 

namespace PerfectBuild\Items;

class Zephyr extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Zephyr");	
		$this->cost = 2850;	
		$this->sell_value = 1995;	
		$this->basic_effects_arr['attack_damage'] = 25;
		$this->basic_effects_arr['attack_speed_percent'] = 0.50;
		$this->basic_effects_arr['movement_speed_percent'] = 0.05;
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.10;
		$this->effects_arr[] = new \PerfectBuild\Effects\Tenacity();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}