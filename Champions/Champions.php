<?php

namespace PerfectBuild\Champions;

Class Champions{
	
	protected $gold;
	protected $level;
	protected $experience;
	
	protected $base_health;
	protected $health_per_level;
	protected $base_health_regen;
	protected $health_regen_per_level;
	
	protected $base_mana;
	protected $mana_per_level;
	protected $base_mana_regen;
	protected $mana_regen_per_level;
	
	protected $base_attack_damage;
	protected $attack_damage_per_level;
	protected $base_attack_speed;
	protected $attack_speed_per_level;
	protected $attack_delay;
	
	protected $base_armor;
	protected $armor_per_level;
	
	protected $base_magic_resist;
	protected $base_movement_speed;
	
	protected $spell_level_arr;
	
	protected $passive_obj;
	
	protected $spell1_obj;
	protected $spell2_obj;
	protected $spell3_obj;
	protected $spell4_obj;
	
	protected $summoner1_obj;
	protected $summoner2_obj;
	
	protected $effects_arr;
		
	public function __construct($summoner_arr, $rune_arr, $masteries_arr) {		
		
		$summoner1 = '\PerfectBuild\Summoners\\'.$summoner_arr[0];
		$summoner2 = '\PerfectBuild\Summoners\\'.$summoner_arr[1];
		
		$this->summoner1_obj 			= new $summoner1();
		$this->summoner2_obj 			= new $summoner2();
		
	}
	
	abstract public function activateSpell1();
	abstract public function activateSpell2();
	abstract public function activateSpell3();
	abstract public function activateSpell4();
	abstract public function activateSummoner1();
	abstract public function activateSummoner2();
	
	public function attack($mob_obj){
		
	}	
	
}

