<?php 

namespace PerfectBuild\Items;

class AegisOfTheLegion extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Aegis of the Legion");	
		$this->cost = 1900;	
		$this->sell_value = 1330;	
		$this->basic_effects_arr['health'] = 200.0;
		$this->basic_effects_arr['magic_resistance'] = 20.0;
		$this->effects_arr[] = new \PerfectBuild\Effects\Legion();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}