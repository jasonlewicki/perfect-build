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
		
	public function __construct() {
		
	}
	
	abstract public function activateSpell1();
	abstract public function activateSpell2();
	abstract public function activateSpell3();
	abstract public function activateSpell4();
	abstract public function activateSummoner1();
	abstract public function activateSummoner2();
	
}
