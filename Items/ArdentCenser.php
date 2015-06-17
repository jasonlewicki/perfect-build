<?php 

namespace PerfectBuild\Items;

class ArdentCenser extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Ardent Censer");	
		$this->cost = 2100;	
		$this->sell_value = 1470;	
		$this->basic_effects_arr['cooldown_reduction_percent'] = 0.10;
		$this->basic_effects_arr['ability_power'] = 40;
		$this->effects_arr[] = new \PerfectBuild\Effects\ArdentCenser();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}