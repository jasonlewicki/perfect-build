<?php

namespace PerfectBuild\Monsters;

abstract Class Monster{
	
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
	
	public function receiveDamage($damage, $damage_type, $attacker_stats){
		
		$true_armor_damage = 0;
		$true_magic_damage = 0;
		$true_damage = 0;
		
		######
		#ARMOR
		######
		if($damage_type == 'armor'){
			// Calculate Armor after reductions and penetrations		
			$effective_armor = (($this->armor() - $attacker_stats['armor_reduction_flat']) * (1 - $attacker_stats['armor_reduction_percent']) * (1 - $attacker_stats['armor_penetration_percent'])) - $attacker_stats['armor_penetration_flat'];
					
			// Apply attack damage
			if ($effective_armor >= 0){
				$effective_armor_reduction = 100 / (100 + $effective_armor);
			}else{
				$effective_armor_reduction = 2 - (100 / (100 - $effective_armor));
			}		
			$true_armor_damage = $damage * $effective_armor_reduction;
		}		
		
		######
		#MAGIC
		######		
		if($damage_type == 'magic'){
			// Calculate Magic Resist after reductions and penetrations
			$effective_magic_resist = (($this->magicResist() - $attacker_stats['magic_resist_reduction_flat']) * (1 - $attacker_stats['magic_resist_reduction_percent']) * (1 - $attacker_stats['magic_resist_penetration_percent'])) - $attacker_stats['magic_resist_penetration_flat'];
			
			// Apply magic damage		
			if ($effective_magic_resist >= 0){
				$effective_magic_resist_reduction = 100 / (100 + $effective_magic_resist);
			}else{
				$effective_magic_resist_reduction = 2 - (100 / (100 - $effective_magic_resist));
			}		
			$true_magic_damage = $damage * $effective_magic_resist_reduction;
		}
		
		######
		#TRUE
		######		
		if($damage_type == 'true'){
			$true_damage = $damage;
		}
		
		######
		#TOTAL
		######
		$total_damage = $true_armor_damage + $true_magic_damage + $true_damage;	
		$this->current_health -= $total_damage;
		
		return Array(
			'total_damage' => $total_damage,
			'total_armor_damage' => $true_armor_damage,
			'total_magic_damage' => $true_magic_damage,
			'total_true_damage' => $true_damage,
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
	
	public function addEffect($name, $option_arr){
		// TODO: Fix this		
		foreach($this->effects_arr as $key => $effect){
			if($effect->name() == "Disable"){
				throw new \Exception("Add Disable Effect Error.");
			}else if($effect->name() == $name){
				$this->effects_arr[$key] = new \PerfectBuild\Effects\Disable($option_arr);	
				return;
			}
		}
		
		$effect_name = "\PerfectBuild\Effects\\".$name;		
		$this->effects_arr[] = new $effect_name($option_arr);
		
		return;			
	}	
	
	public function stats(){
			
		$stats_arr = Array(
			'attack_damage'						=> $this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level),
			'ability_power'						=> 0.0,
			'armor_penetration_flat' 			=> 0.0,
			'armor_penetration_percent' 		=> 0.0,
			'armor_reduction_flat' 				=> 0.0,
			'armor_reduction_percent'			=> 0.0,
			'magic_resist_reduction_flat' 		=> 0.0,
			'magic_resist_reduction_percent' 	=> 0.0,
			'magic_resist_penetration_flat' 	=> 0.0,
			'magic_resist_penetration_percent' 	=> 0.0
		);
			
		// TODO: Fix this		
		foreach($this->effects_arr as $effect){
			if($effect->name() == "Armor Penetration Flat"){
				$stats_arr['armor_penetration_flat'] = $effect->value();
			}else if($effect->name() == "Armor Penetration Percent"){
				$stats_arr['armor_penetration_percent'] = $effect->value();
			}else if($effect->name() == "Armor Reduction Flat"){
				$stats_arr['armor_reduction_flat'] = $effect->value();
			}else if($effect->name() == "Armor Reduction Percent"){
				$stats_arr['armor_reduction_percent'] = $effect->value();
			}else if($effect->name() == "Magic Resist Reduction Flat"){
				$stats_arr['magic_resist_reduction_flat'] = $effect->value();
			}else if($effect->name() == "Magic Resist Reduction Percent"){
				$stats_arr['magic_resist_reduction_percent'] = $effect->value();
			}else if($effect->name() == "Magic Resist Penetration Flat "){
				$stats_arr['magic_resist_penetration_flat'] = $effect->value();
			}else if($effect->name() == "Magic Resist Penetration Percent"){
				$stats_arr['magic_resist_penetration_percent'] = $effect->value();
			}
			
			else if($effect->name() == "Dread"){
				$stats_arr['magic_resist_reduction_flat'] = 10;
			}
			
		}
		
		return $stats_arr;			
	}		
		
	
	public function tick($tick_rate){
		// TODO: Fix this	
		
		$damage_arr =  Array(
			'total_damage' => 0,
			'total_armor_damage' => 0,
			'total_magic_damage' => 0,
			'total_true_damage' => 0,
		);	
			
		foreach($this->effects_arr as $key => &$effect){
			$effects_arr = $effect->tick($tick_rate);
			if($effects_arr['expire'] === true){
				unset($this->effects_arr[$key]);
			}else{
				if(isset($effects_arr['damage_arr'])){
					$damage_arr['total_damage'] += $effects_arr['damage_arr']['total_damage'];
					$damage_arr['total_armor_damage'] += $effects_arr['damage_arr']['total_armor_damage'];
					$damage_arr['total_magic_damage'] += $effects_arr['damage_arr']['total_magic_damage'];
					$damage_arr['total_true_damage'] += $effects_arr['damage_arr']['total_true_damage'];
				}
			}
		}
		return $damage_arr;
	}	
	
}
