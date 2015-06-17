<?php 

namespace PerfectBuild\Items;

class AthenesUnholyGrail extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Athene's Unholy Grail");	
		$this->cost = 2700;	
		$this->sell_value = 1820;	
		$this->basic_effects_arr['ability_power'] = 60.0;
		$this->basic_effects_arr['magic_resistance'] = 25.0;
		$this->basic_effects_arr['mana_regeneration_per_5_percent'] = 1.0;
		$this->basic_effects_arr['cooldown_reduction'] = 0.20;
		$this->effects_arr[] = new \PerfectBuild\Effects\ManaFont();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}