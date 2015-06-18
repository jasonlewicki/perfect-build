<?php 

namespace PerfectBuild\Items;

class HextechRevolver extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Hextech Revolver");	
		$this->cost = 1200;	
		$this->sell_value = 840;	
		$this->basic_effects_arr['ability_power'] = 40;
		$this->effects_arr[] = new \PerfectBuild\Effects\HextechRevolver();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}