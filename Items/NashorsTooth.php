<?php 

namespace PerfectBuild\Items;

class NashorsTooth extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Nashor's Tooth");	
		$this->cost = 2920;	
		$this->sell_value = 2044;	
		$this->basic_effects_arr['attack_speed_percent'] = 0.50;
		$this->basic_effects_arr['ability_power'] = 60;
		$this->effects_arr[] = new \PerfectBuild\Effects\NashorsTooth();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}