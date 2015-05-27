<?php

namespace PerfectBuild\Champions;

abstract Class Champion{
	
	protected $gold;
	protected $level;
	protected $experience;
	protected $current_health;
	protected $current_mana;
	protected $current_fury;
	
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
	
	protected $base_magic_resistance;
	
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
		
		$this->effects_arr = Array();
		
		$summoner1 = '\PerfectBuild\Summoners\\'.$summoner_arr[0];
		$summoner2 = '\PerfectBuild\Summoners\\'.$summoner_arr[1];
		
		$this->summoner1_obj 			= new $summoner1();
		$this->summoner2_obj 			= new $summoner2();
		
	}
	
	abstract public function spell1($mob_obj);
	abstract public function spell2($mob_obj);
	abstract public function spell3($mob_obj);
	abstract public function spell4($mob_obj);	
	
	public function levelSpell1(){
		$this->spell1_obj->level();
	}	
	public function levelSpell2(){
		$this->spell2_obj->level();
	}
	public function levelSpell3(){
		$this->spell3_obj->level();
	}
	public function levelSpell4(){
		$this->spell4_obj->level();
	}
	
	public function summoner1(){
		
	}
	
	public function summoner2(){
		
	}
	
	public function attack($mob_obj){
		
		// TODO: Apply passives and on hits
		
		// Disable champion from other things while attacking
		$this->addEffect('Disable', Array('duration' => $this->attackSpeed()));
		return $mob_obj->receiveDamage($this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level), 'armor', $this->stats());	
			
	}	
	
	public function receiveDamage($damage, $damage_type, $attacker_stats){
		
		$true_armor_damage = 0;
		$true_magic_damage = 0;
		$true_damage = 0;
		
		$stats_arr = $this->stats();
		
		######
		#ARMOR
		######
		
		// Combine auras and effects on target with the person attacking
		$armor_reduction_flat = $attacker_stats['armor_reduction_flat'] + $stats_arr['self_armor_reduction_flat'];
		$armor_reduction_percent = ($attacker_stats['armor_reduction_percent'] || $stats_arr['self_armor_reduction_percent']) == 0.0 ? ($attacker_stats['armor_reduction_percent'] + $stats_arr['self_armor_reduction_percent']) : ($attacker_stats['armor_reduction_percent'] * $stats_arr['self_armor_reduction_percent']);
		$armor_penetration_percent = ($attacker_stats['armor_penetration_percent'] || $stats_arr['self_armor_penetration_percent']) == 0.0 ? ($attacker_stats['armor_penetration_percent'] + $stats_arr['self_armor_penetration_percent']) : ($attacker_stats['armor_penetration_percent'] * $stats_arr['self_armor_penetration_percent']);
		$armor_penetration_flat = $attacker_stats['armor_penetration_flat'] + $stats_arr['self_armor_penetration_flat'];
		
		if($damage_type == 'armor'){
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
		
		// Combine auras and effects on target with the person attacking
		$magic_resistance_reduction_flat = $attacker_stats['magic_resistance_reduction_flat'] + $stats_arr['self_magic_resistance_reduction_flat'];
		$magic_resistance_reduction_percent = ($attacker_stats['magic_resistance_reduction_percent'] || $stats_arr['self_magic_resistance_reduction_percent']) == 0.0 ? ($attacker_stats['magic_resistance_reduction_percent'] + $stats_arr['self_magic_resistance_reduction_percent']) : ($attacker_stats['magic_resistance_reduction_percent'] * $stats_arr['self_magic_resistance_reduction_percent']);
		$magic_resistance_penetration_percent = ($attacker_stats['magic_resistance_penetration_percent'] || $stats_arr['self_magic_resistance_penetration_percent']) == 0.0 ? ($attacker_stats['magic_resistance_penetration_percent'] + $stats_arr['self_magic_resistance_penetration_percent']) : ($attacker_stats['magic_resistance_penetration_percent'] * $stats_arr['self_magic_resistance_penetration_percent']);
		$magic_resistance_penetration_flat = $attacker_stats['magic_resistance_penetration_flat'] + $stats_arr['self_magic_resistance_penetration_flat'];
		
			
		if($damage_type == 'magic'){
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
				return false;
			}
		}
		return true;
	}		
	
	public function attackSpeed(){
		// TODO: Fix this		
		return $this->base_attack_speed;
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
			'base_attack_damage'						=> $this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level),
			'bonus_attack_damage'						=> 0.0,
			'attack_damage'								=> $this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level),
			'attack_speed'								=> $this->base_attack_speed +  ((1 - $this->level) * $this->attack_speed_per_level),
			'ability_power'								=> 0.0,
			'armor_penetration_flat' 					=> 0.0,
			'armor_penetration_percent' 				=> 0.0,
			'armor_reduction_flat' 						=> 0.0,
			'armor_reduction_percent'					=> 0.0,
			'magic_resistance_reduction_flat' 			=> 0.0,
			'magic_resistance_reduction_percent' 		=> 0.0,
			'magic_resistance_penetration_flat' 		=> 0.0,
			'magic_resistance_penetration_percent' 		=> 0.0,
			'magic_resistance' 							=> $this->base_magic_resistance,
			'armor' 									=> $this->base_armor + ((1 - $this->level) * $this->armor_per_level),
			'movement_speed' 							=> $this->base_movement_speed,
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
					}else if($basic_effect_key == "self_magic_resistance_penetration_percent"){
						$stats_arr['self_magic_resistance_reduction_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_penetration_flat"){
						$stats_arr['self_magic_resistance_reduction_percent'] = $stats_arr['self_magic_resistance_reduction_percent'] == 0.0? $basic_effect_value : $stats_arr['self_magic_resistance_reduction_percent'] * $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_reduction_percent"){
						$stats_arr['self_magic_resistance_penetration_flat'] += $basic_effect_value;
					}else if($basic_effect_key == "self_magic_resistance_reduction_flat"){
						$stats_arr['self_magic_resistance_penetration_percent'] = $stats_arr['self_magic_resistance_penetration_percent'] == 0.0? $basic_effect_value : $stats_arr['self_magic_resistance_penetration_percent'] * $basic_effect_value;
					}
				}
			}			
		}
			
		// Calculate Armor after reductions and penetrations		
		$stats_arr['armor'] = (($stats_arr['armor'] - $stats_arr['self_armor_reduction_flat']) * (1 - $stats_arr['self_armor_reduction_percent']) * (1 - $stats_arr['self_armor_penetration_percent'])) - $stats_arr['self_armor_penetration_flat'];
			
		// Calculate Magic Resist after reductions and penetrations
		$stats_arr['magic_resistance'] = (($stats_arr['magic_resistance'] - $stats_arr['self_magic_resistance_reduction_flat']) * (1 - $stats_arr['self_magic_resistance_reduction_percent']) * (1 - $stats_arr['self_magic_resistance_penetration_percent'])) - $stats_arr['self_magic_resistance_penetration_flat'];
			
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

