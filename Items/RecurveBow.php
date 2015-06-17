<?php 

namespace PerfectBuild\Items;

class RecurveBow extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Recurve Bow");	
		$this->cost = 1100;	
		$this->sell_value = 770;	
		$this->basic_effects_arr['attack_speed_percent'] = 0.30;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}