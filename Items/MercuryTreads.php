<?php 

namespace PerfectBuild\Items;

class MercuryTreads extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Mercury Treads");	
		$this->cost = 1200;	
		$this->sell_value = 840;	
		$this->effects_arr[] = new \PerfectBuild\Effects\EnchancedMovement(Array('movement_speed_flat'=>45));
		$this->effects_arr[] = new \PerfectBuild\Effects\MercuryTreads();
		$this->effects_arr[] = new \PerfectBuild\Effects\Tenacity();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}