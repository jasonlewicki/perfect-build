<?php 

namespace PerfectBuild\Items;

class VampiricScepter extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Vampiric Scepter");	
		$this->cost = 800;	
		$this->sell_value = 560;	
		$this->basic_effects_arr['attack_damage'] = 10;
		$this->basic_effects_arr['lifesteal_percent'] = 0.08;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}