<?php 

namespace PerfectBuild\Items;

class RubyCrystal extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Ruby Crystal");	
		$this->cost = 400;	
		$this->sell_value = 280;	
		$this->basic_effects_arr['health'] = 150;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}