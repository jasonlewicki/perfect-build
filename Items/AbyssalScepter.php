<?php 

namespace PerfectBuild\Items;

class AbyssalScepter extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Abyssal Scepter");	
		$this->cost = 2440;
		$this->sell_value = 1708;
		$this->basic_effects_arr['ability_power'] = 70.0;
		$this->basic_effects_arr['magic_resistance'] = 50.0;
		$this->effects_arr[] = new \PerfectBuild\Effects\AbyssalScepter();
	}
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}