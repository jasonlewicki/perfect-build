<?php 

namespace PerfectBuild\Items;

class NegatronCloak extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Negatron Cloak");	
		$this->cost = 850;	
		$this->sell_value = 595;	
		$this->basic_effects_arr['magic_resistance'] = 45;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}