<?php 

namespace PerfectBuild\Items;

clasBrawlersGloves extends \PerfectBuild\Items\Item{
			
	// Constructor
	public function __construct() {		
		parent::__construct("Brawler's Gloves");
		$this->cost = 400;		
		$this->sell_value = 280;	
		$this->basic_effects_arr['critical_chance_percent'] = 8.0;	
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}