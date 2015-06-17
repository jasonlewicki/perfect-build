<?php 

namespace PerfectBuild\Items;

class WarmogsArmor extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Warmog's Armor");	
		$this->cost = 2500;	
		$this->sell_value = 1981;	
		$this->basic_effects_arr['health'] = 800;
		$this->effects_arr[] = new \PerfectBuild\Effects\WarmogsArmor();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}