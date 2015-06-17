<?php 

namespace PerfectBuild\Items;

class NullMagicMantle extends \PerfectBuild\Items\Item{
		
	// Constructor
	public function __construct() {		
		parent::__construct("Null-Magic Mantle");	
		$this->cost = 500;	
		$this->sell_value = 350;	
		$this->basic_effects_arr['magic_resistance'] = 20;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}