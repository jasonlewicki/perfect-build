<?php

namespace PerfectBuild\Monsters;

abstract Class Monsters{
	
	protected $level;
	protected $gold;
	protected $experience;
	protected $health;
	protected $current_health;
	protected $attack_damage;
	protected $attack_speed;
	protected $armor;
	protected $magic_resistance;
	protected $movement_speed;
	protected $spawn_time;
	protected $respawn_time;
	
	protected $effects_arr;
	
	public function __construct() {
		
		$this->effects_arr = Array();
		
	}
	
	public function receiveDamage($attack_arr){
		######
		#ARMOR
		######
		// Calculate Armor after reductions and penetrations		
		$effective_armor = (($this->armor() - $attack_arr['armor_reduction_flat']) * (1 - $attack_arr['armor_reduction_percent']) * (1 - $attack_arr['armor_penetration_percent'])) - $attack_arr['armor_penetration_flat'];
				
		// Apply attack damage
		if ($effective_armor >= 0){
			$effective_armor_reduction = 100 / (100 + $effective_armor);
		}else{
			$effective_armor_reduction = 2 - (100 / (100 - $effective_armor));
		}		
		$true_attack_damage = $attack_arr['attack_damage'] * $effective_armor_reduction;		
		
		######
		#MAGIC
		######		
		// Calculate Magic Resist after reductions and penetrations
		$effective_magic_resist = (($this->magicResist() - $attack_arr['magic_resist_reduction_flat']) * (1 - $attack_arr['magic_resist_reduction_percent']) * (1 - $attack_arr['magic_resist_penetration_percent'])) - $attack_arr['magic_resist_penetration_flat'];
		
		// Apply magic damage		
		if ($effective_magic_resist >= 0){
			$effective_magic_resist_reduction = 100 / (100 + $effective_magic_resist);
		}else{
			$effective_magic_resist_reduction = 2 - (100 / (100 - $effective_magic_resist));
		}		
		$true_magic_damage = $attack_arr['magic_damage'] * $effective_magic_resist_reduction;
		
		######
		#TOTAL
		######
		$total_damage = $true_attack_damage + $true_magic_damage;	
		$this->current_health -= $total_damage;
		
		return Array(
			'total_damage' => $total_damage,
			'total_attack_damage' => $true_attack_damage,
			'total_magic_damage' => $true_magic_damage,
		);		
	}	
		
	public function free(){
		foreach($this->effects_arr as $effect){
			if($effect->name() == "Disable"){
				return true;
			}
		}
		return false;
	}	
	
	public function armor(){		
		return $this->armor;
	}	
	
	public function magicResist(){		
		return $this->magic_resistance;
	}	
	
	public function tick($tick_rate){
		// TODO: Fix this		
		foreach($this->effects_arr as &$effect){
			$effects_arr = $effect->tick($tick_rate);
			if($effects_arr['expire'] === true){
				unset($effect);
			}else{
				
			}
		}
	}	
	
}
