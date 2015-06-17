<?php 

namespace PerfectBuild\Items;

class CloakOfAgility extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Cloak of Agility");	
		$this->cost = 730;	
		$this->sell_value = 511;	
		$this->basic_effects_arr['critical_chance_percent'] = 0.15;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}