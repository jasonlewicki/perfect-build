<?php 

namespace PerfectBuild\Items;

class TheBrutalizer extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("The Brutalizer");	
		$this->cost = 1337;	
		$this->sell_value = 936;	
		$this->basic_effects_arr['attack_damage'] = 25;
		$this->effects_arr[] = new \PerfectBuild\Effects\TheBrutalizer();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}