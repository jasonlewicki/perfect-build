<?php 

namespace PerfectBuild\Items;

class LastWhisper extends \PerfectBuild\Items\Item{
	
	protected $interval;
		
	// Constructor
	public function __construct() {		
		parent::__construct("Last Whisper");	
		$this->cost = 2300;	
		$this->sell_value = 1610;	
		$this->basic_effects_arr['attack_damage'] = 25;
		$this->effects_arr[] = new \PerfectBuild\Effects\LastWhisper();
	}	
	
	public function activate($caster_obj, $mob_obj){
		throw new \Exception('Un-Activatable Item Exeception');	
	}
}