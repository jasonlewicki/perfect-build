<?php 

namespace PerfectBuild\Items;

class AmplifyingTome extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Amplifying Tome");	
		$this->cost = 435;	
		$this->sell_value = 305;	
		$this->basic_effects_arr['ability_power'] = 20.0;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}