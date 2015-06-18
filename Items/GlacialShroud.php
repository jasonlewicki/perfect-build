<?php 

namespace PerfectBuild\Items;

class GlacialShroud extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Glacial Shroud");	
		$this->cost = 950;	
		$this->sell_value = 665;	
		$this->basic_effects_arr['armor'] = 20;
		$this->basic_effects_arr['mana'] = 250;
		$this->effects_arr[] = new \PerfectBuild\Effects\GlacialShroud();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}