<?php 

namespace PerfectBuild\Items;

class NeedlesslyLargeRod extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Needlessly Large Rod");
		$this->cost = 1600;	
		$this->sell_value = 1120;	
		$this->basic_effects_arr['ability_power'] = 80.0;	
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}