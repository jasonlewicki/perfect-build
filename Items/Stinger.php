<?php 

namespace PerfectBuild\Items;

class Stinger extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Stinger");	
		$this->cost = 1250;	
		$this->sell_value = 875;	
		$this->basic_effects_arr['attack_speed_percent'] = 0.40;
		$this->effects_arr[] = new \PerfectBuild\Effects\Stinger();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}