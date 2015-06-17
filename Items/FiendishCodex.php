<?php 

namespace PerfectBuild\Items;

class FiendishCodex extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Fiendish Codex");	
		$this->cost = 820;	
		$this->sell_value = 574;	
		$this->basic_effects_arr['ability_power'] = 30;
		$this->effects_arr[] = new \PerfectBuild\Effects\FiendishCodex();
	}	
		
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}