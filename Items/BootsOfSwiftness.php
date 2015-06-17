<?php 

namespace PerfectBuild\Items;

class BootsOfSwiftness extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Boots of Swiftness");	
		$this->cost = ;	
		$this->sell_value = ;	
		//$this->basic_effects_arr['cooldown_reduction_percent'] = 0.10;
		//$this->effects_arr[] = new \PerfectBuild\Effects\ArdentCenser();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}