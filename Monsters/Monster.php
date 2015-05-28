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
		
		$stats_arr = $this->stats();
		
		######
		#ARMOR
		######		
		
		if($damage_type == 'armor'){
			
			// Combine auras and effects on target with the person attacking
			$armor_reduction_flat = $attacker_stats['armor_reduction_flat'] + $stats_arr['self_armor_reduction_flat'];
			$armor_reduction_percent = ($attacker_stats['armor_reduction_percent'] || $stats_arr['self_armor_reduction_percent']) == 0.0 ? ($attacker_stats['armor_reduction_percent'] + $stats_arr['self_armor_reduction_percent']) : ($attacker_stats['armor_reduction_percent'] * $stats_arr['self_armor_reduction_percent']);
			$armor_penetration_percent = ($attacker_stats['armor_penetration_percent'] || $stats_arr['self_armor_penetration_percent']) == 0.0 ? ($attacker_stats['armor_penetration_percent'] + $stats_arr['self_armor_penetration_percent']) : ($attacker_stats['armor_penetration_percent'] * $stats_arr['self_armor_penetration_percent']);
			$armor_penetration_flat = $attacker_stats['armor_penetration_flat'] + $stats_arr['self_armor_penetration_flat'];
					
			// Calculate Armor after reductions and penetrations	
			$armor_calc_part_1 = $stats_arr['armor'] - $armor_reduction_flat;			
			$armor_calc_part_2 = $armor_calc_part_1 * (1 - $armor_reduction_percent);					
			if ($armor_calc_part_2 > 0){
				$armor_calc_part_3 = $armor_calc_part_2 * (1 - $armor_penetration_percent);
				$armor_calc_part_4 = $armor_calc_part_3 - $armor_penetration_flat;
				if ($armor_calc_part_4 < 0){
					$armor_calc_part_4 = 0;
				}	
				$effective_armor = $armor_calc_part_4;
			}else{
				$effective_armor = $armor_calc_part_2;
			}		
					
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
			
			// Combine auras and effects on target with the person attacking
			$magic_resistance_reduction_flat = $attacker_stats['magic_resistance_reduction_flat'] + $stats_arr['self_magic_resistance_reduction_flat'];
			$magic_resistance_reduction_percent = ($attacker_stats['magic_resistance_reduction_percent'] || $stats_arr['self_magic_resistance_reduction_percent']) == 0.0 ? ($attacker_stats['magic_resistance_reduction_percent'] + $stats_arr['self_magic_resistance_reduction_percent']) : ($attacker_stats['magic_resistance_reduction_percent'] * $stats_arr['self_magic_resistance_reduction_percent']);
			$magic_resistance_penetration_percent = ($attacker_stats['magic_resistance_penetration_percent'] || $stats_arr['self_magic_resistance_penetration_percent']) == 0.0 ? ($attacker_stats['magic_resistance_penetration_percent'] + $stats_arr['self_magic_resistance_penetration_percent']) : ($attacker_stats['magic_resistance_penetration_percent'] * $stats_arr['self_magic_resistance_penetration_percent']);
			$magic_resistance_penetration_flat = $attacker_stats['magic_resistance_penetration_flat'] + $stats_arr['self_magic_resistance_penetration_flat'];
			
			// Calculate Magic Resist after reductions and penetrations
			$magic_resistance_calc_part_1 = $stats_arr['magic_resistance'] - $magic_resistance_reduction_flat;			
			$magic_resistance_calc_part_2 = $magic_resistance_calc_part_1 * (1 - $magic_resistance_reduction_percent);					
			if ($magic_resistance_calc_part_2 > 0){
				$magic_resistance_calc_part_3 = $magic_resistance_calc_part_2 * (1 - $magic_resistance_penetration_percent);
				$magic_resistance_calc_part_4 = $magic_resistance_calc_part_3 - $magic_resistance_penetration_flat;
				if ($magic_resistance_calc_part_4 < 0){
					$magic_resistance_calc_part_4 = 0;
				}	
				$effective_magic_resistance = $magic_resistance_calc_part_4;
			}else{
				$effective_magic_resistance = $magic_resistance_calc_part_2;
			}		
			
			// Apply magic damage		
			if ($effective_magic_resistance >= 0){
				$effective_magic_resistance_reduction = 100 / (100 + $effective_magic_resistance);
			}else{
				$effective_magic_resistance_reduction = 2 - (100 / (100 - $effective_magic_resistance));
			}		
			$true_magic_damage = $damage * $effective_magic_resistance_reduction;
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
		
	public function addEffect($name, $option_arr){
		// TODO: Fix this		
		foreach($this->effects_arr as $key => $effect){ 
			if($effect->name() == $name){
				if($effect->isUnique()){
					$effect_name = "\PerfectBuild\Effects\\".$name;		
					$this->effects_arr[$key] = new $effect_name($option_arr);	
					return;					
				}else{
					break;
				}
			}
		}
		$effect_name = "\PerfectBuild\Effects\\".$name;		
		$this->effects_arr[] = new $effect_name($option_arr);
		
		return;			
	}	
	
	public function stats(){
			
		$stats_arr = Array(				
			'attack_damage'								=> $this->attack_damage,
			'attack_speed'								=> $this->attack_speed,
			'ability_power'								=> 0.0,
			'armor_penetration_flat' 					=> 0.0,
			'armor_penetration_percent' 				=> 0.0,
			'armor_reduction_flat' 						=> 0.0,
			'armor_reduction_percent'					=> 0.0,
			'magic_resistance_reduction_flat' 			=> 0.0,
			'magic_resistance_reduction_percent' 		=> 0.0,
			'magic_resistance_penetration_flat' 		=> 0.0,
			'magic_resistance_penetration_percent' 		=> 0.0,
			'magic_resistance' 							=> $this->magic_resistance,
			'armor' 									=> $this->armor,			
			/*
			'base_health'								=> $this->base_health + ((1 - $this->level) * $this->health_per_level),
			'health'									=> $this->base_health + ((1 - $this->level) * $this->health_per_level),
			'health_regeneration_per_5'					=> $this->base_health_regen + ((1 - $this->level) * $this->health_regen_per_level),
			'movement_speed'							=> $this->base_movement_speed,
			'lifesteal_percent'							=> 0.0,
			'spell_vamp_percent' 						=> 0.0,
			*/
			'self_armor_penetration_flat' 				=> 0.0,
			'self_armor_penetration_percent' 			=> 0.0,
			'self_armor_reduction_flat' 				=> 0.0,
			'self_armor_reduction_percent'				=> 0.0,
			'self_magic_resistance_reduction_flat' 		=> 0.0,
			'self_magic_resistance_reduction_percent' 	=> 0.0,
			'self_magic_resistance_penetration_flat' 	=> 0.0,
			'self_magic_resistance_penetration_percent'	=> 0.0,
		);	
			
		// TODO: Fix this		
		foreach($this->effects_arr as $effect){
			$basic_effects_arr = $effect->basicEffectsArr();
			
			if(!empty($basic_effects_arr)){
				foreach($basic_effects_arr as $basic_effect_key => $basic_effect_value){
					# Outgoing effects					
					if($basic_effect_key == "armor_penetration_flat"){
						$stats_arr['armor_penetration_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "armor_penetration_percent"){
						$stats_arr['armor_penetration_percent'] = $stats_arr['armor_penetration_percent'] == 0.0? $basic_effect_value : $stats_arr['armor_penetration_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "armor_reduction_flat"){
						$stats_arr['armor_reduction_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "armor_reduction_percent"){
						$stats_arr['armor_reduction_percent'] = $stats_arr['armor_reduction_percent'] == 0.0? $basic_effect_value : $stats_arr['armor_reduction_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "magic_resistance_reduction_flat"){
						$stats_arr['magic_resistance_reduction_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "magic_resistance_reduction_percent"){
						$stats_arr['magic_resistance_reduction_percent'] = $stats_arr['magic_resistance_reduction_percent'] == 0.0? $basic_effect_value : $stats_arr['magic_resistance_reduction_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "magic_resistance_penetration_flat"){
						$stats_arr['magic_resistance_penetration_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "magic_resistance_penetration_percent"){
						$stats_arr['magic_resistance_penetration_percent'] = $stats_arr['magic_resistance_penetration_percent'] == 0.0? $basic_effect_value : $stats_arr['magic_resistance_penetration_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "ability_power"){
						$stats_arr['ability_power'] += $basic_effect_value;
					}else if($basic_effect_key == "ability_power_scaling"){
						$stats_arr['ability_power'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "armor"){
						$stats_arr['armor'] += $basic_effect_value;
					}else if($basic_effect_key == "armor_scaling"){
						$stats_arr['armor_scaling'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "attack_damage"){
						$stats_arr['bonus_attack_damage'] += $basic_effect_value;
						$stats_arr['attack_damage'] = $stats_arr['base_attack_damage'] + $stats_arr['bonus_attack_damage'];
					}else if($basic_effect_key == "attack_damage_scaling"){
						$stats_arr['bonus_attack_damage'] += $basic_effect_value * $this->level;
						$stats_arr['attack_damage'] = $stats_arr['base_attack_damage'] + $stats_arr['bonus_attack_damage'];
					}else if($basic_effect_key == "attack_speed_percent"){
						$stats_arr['bonus_attack_speed'] += $basic_effect_value;
						$stats_arr['attack_speed'] = $stats_arr['base_attack_speed'] * (1 + $stats_arr['bonus_attack_speed']);
					}else if($basic_effect_key == "cooldown_reduction_percent"){
						$stats_arr['cooldown_reduction'] += $basic_effect_value;
					}else if($basic_effect_key == "cooldown_reduction_scaling_percent"){
						$stats_arr['cooldown_reduction'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "critical_chance_percent"){
						$stats_arr['critical_chance_percent'] += $basic_effect_value;
					}else if($basic_effect_key == "critical_damage_percent"){
						$stats_arr['critical_damage_percent'] += $basic_effect_value;
					}else if($basic_effect_key == "energy"){
						$stats_arr['energy'] += $basic_effect_value;
					}else if($basic_effect_key == "energy_regeneration_per_5"){
						$stats_arr['energy_regeneration_per_5'] += $basic_effect_value;
					}else if($basic_effect_key == "experience_percent"){
						$stats_arr['experience_percent'] += $basic_effect_value;
					}else if($basic_effect_key == "gold_per_10"){
						$stats_arr['gold_per_10'] += $basic_effect_value;
					}else if($basic_effect_key == "health"){
						$stats_arr['bonus_health'] += $basic_effect_value;
						$stats_arr['health'] = ($stats_arr['base_health'] + $stats_arr['bonus_health']) * (1 + $stats_arr['bonus_health_percent']);
					}else if($basic_effect_key == "health_percent"){
						$stats_arr['bonus_health_percent'] += $basic_effect_value;
						$stats_arr['health'] = ($stats_arr['base_health'] + $stats_arr['bonus_health']) * (1 + $stats_arr['bonus_health_percent']);
					}else if($basic_effect_key == "health_regeneration_per_5"){
						$stats_arr['health_regeneration_per_5'] += $basic_effect_value;
					}else if($basic_effect_key == "health_regeneration_scaling_per_5"){
						$stats_arr['health_regeneration_per_5'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "health_scaling"){
						$stats_arr['bonus_health'] += $basic_effect_value * $this->level;
						$stats_arr['health'] = ($stats_arr['base_health'] + $stats_arr['bonus_health']) * (1 + $stats_arr['bonus_health_percent']);
					}else if($basic_effect_key == "lifesteal_percent"){
						$stats_arr['lifesteal_percent'] += $basic_effect_value;
					}else if($basic_effect_key == "magic_resistance"){
						$stats_arr['magic_resistance'] += $basic_effect_value;
					}else if($basic_effect_key == "magic_resistance_scaling"){
						$stats_arr['magic_resistance'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "mana"){
						$stats_arr['mana'] += $basic_effect_value;
					}else if($basic_effect_key == "mana_scaling"){
						$stats_arr['mana'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "mana_regeneration_per_5"){
						$stats_arr['mana_regeneration_per_5'] += $basic_effect_value;
					}else if($basic_effect_key == "mana_regeneration_scaling_per_5"){
						$stats_arr['mana_regeneration_per_5'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "mana_scaling"){
						$stats_arr['mana'] += $basic_effect_value * $this->level;
					}else if($basic_effect_key == "movement_speed_percent"){
						$stats_arr['bonus_movement_speed_percent'] += $basic_effect_value;
					}else if($basic_effect_key == "movement_speed_flat"){
						$stats_arr['bonus_movement_speed_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "revival"){
						$stats_arr['revival_percent'] += $basic_effect_value;
					}else if($basic_effect_key == "spell_vamp_percent"){
						$stats_arr['spell_vamp_percent'] += $basic_effect_value;
					}					
					
					# Incoming effects
					else if($basic_effect_key == "self_armor_penetration_flat"){
						$stats_arr['self_armor_penetration_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "self_armor_penetration_percent"){
						$stats_arr['self_armor_penetration_percent'] = $stats_arr['self_armor_penetration_percent'] == 0.0? $basic_effect_value : $stats_arr['self_armor_penetration_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "self_armor_reduction_flat"){
						$stats_arr['self_armor_reduction_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "self_armor_reduction_percent"){
						$stats_arr['self_armor_reduction_percent'] = $stats_arr['self_armor_reduction_percent'] == 0.0? $basic_effect_value : $stats_arr['self_armor_reduction_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_reduction_flat"){
						$stats_arr['self_magic_resistance_reduction_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_reduction_percent"){
						$stats_arr['self_magic_resistance_reduction_percent'] = $stats_arr['self_magic_resistance_reduction_percent'] == 0.0? $basic_effect_value : $stats_arr['self_magic_resistance_reduction_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_penetration_flat"){
						$stats_arr['self_magic_resistance_penetration_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_penetration_percent"){
						$stats_arr['self_magic_resistance_penetration_percent'] = $stats_arr['self_magic_resistance_penetration_percent'] == 0.0? $basic_effect_value : $stats_arr['self_magic_resistance_penetration_percent'] * $basic_effect_value;
					}
				}
			}			
		}
			
		// Calculate Armor after reductions and penetrations		
		//$stats_arr['armor'] = (($stats_arr['armor'] - $stats_arr['self_armor_reduction_flat']) * (1 - $stats_arr['self_armor_reduction_percent']) * (1 - $stats_arr['self_armor_penetration_percent'])) - $stats_arr['self_armor_penetration_flat'];
			
		// Calculate Magic Resist after reductions and penetrations
		//$stats_arr['magic_resistance'] = (($stats_arr['magic_resistance'] - $stats_arr['self_magic_resistance_reduction_flat']) * (1 - $stats_arr['self_magic_resistance_reduction_percent']) * (1 - $stats_arr['self_magic_resistance_penetration_percent'])) - $stats_arr['self_magic_resistance_penetration_flat'];
			
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
