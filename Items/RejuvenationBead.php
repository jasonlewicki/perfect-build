<?php 

namespace PerfectBuild\Items;

class RejuvenationBead extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Rejuventation Bead");	
		$this->cost = 180;	
		$this->sell_value = 126;	
		$this->basic_effects_arr['health_regeneration_percent'] = 0.50;
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}