<?php 

namespace PerfectBuild\Champions;

class Fiddlesticks extends \PerfectBuild\Champions\Champion{
		
	// Constructor
	public function __construct($level, $spell_level_arr, $summoner_arr, $item_arr, $rune_arr, $masteries_arr) {		
		parent::__construct($summoner_arr, $item_arr, $rune_arr, $masteries_arr);			
			
		// After implementation of masteries...
		//$this->gold						= 0;
		$this->level					= $level;
		$this->experience				= 0;
		$this->base_health				= 524;
		$this->health_per_level			= 80;
		$this->base_health_regen		= 5.6;
		$this->health_regen_per_level	= 0.6;
		$this->base_mana				= 350;
		$this->mana_per_level			= 59;
		$this->base_mana_regen			= 6.0;
		$this->mana_regen_per_level		= 0.8;
		$this->base_attack_damage		= 48;
		$this->attack_damage_per_level	= 2.6470588235294117647058823529412;
		$this->base_attack_speed		= 0.625;
		$this->attack_speed_per_level	= 2.1117647058823529411764705882353;
		$this->attack_delay				= 0.0;
		$this->base_armor				= 20.9;
		$this->armor_per_level			= 3.5;
		$this->base_magic_resistance	= 30;
		$this->base_movement_speed		= 335;
		
		$this->spell_level_arr 			= $spell_level_arr;
		
		$this->passive_obj 				= new \PerfectBuild\Spells\Dread();
				
		$this->spell1_obj 				= new \PerfectBuild\Spells\Terrify();
		$this->spell2_obj 				= new \PerfectBuild\Spells\Drain();
		$this->spell3_obj 				= new \PerfectBuild\Spells\DarkWind();
		$this->spell4_obj 				= new \PerfectBuild\Spells\Crowstorm();
				
	}

	public function attack($mob_obj){
		return parent::attack($mob_obj);
	}	
	
	public function spell1($mob_obj){
		$this->spell1_obj->cast($this, $mob_obj);
	}
	
	public function spell2($mob_obj){
		$this->spell2_obj->cast($this, $mob_obj);		
	}
	
	public function spell3($mob_obj){
		$this->spell3_obj->cast($this, $mob_obj);		
	}
	
	public function spell4($mob_obj){
		$this->spell4_obj->cast($this, $mob_obj);		
	}	
}