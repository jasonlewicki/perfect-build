<?php 

namespace PerfectBuild\Items;

class AetherWisp extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Aether Wisp");	
		$this->cost = 850;	
		$this->sell_value = 595;	
		$this->basic_effects_arr['ability_power'] = 30.0;
		$this->effects_arr[] = new \PerfectBuild\Effects\AetherWisp();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}