<?php 

namespace PerfectBuild\Items;

class VoidStaff extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Void Staff");	
		$this->cost = 2295;	
		$this->sell_value = 1607;	
		$this->basic_effects_arr['ability_power'] = 70;
		$this->effects_arr[] = new \PerfectBuild\Effects\VoidStaff();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}