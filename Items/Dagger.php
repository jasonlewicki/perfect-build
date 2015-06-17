<?php 

namespace PerfectBuild\Items;

class Dagger extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Dagger");	
		$this->cost = 450;	
		$this->sell_value = 315;	
		$this->basic_effects_arr['attack_speed_percent'] = 0.15;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}