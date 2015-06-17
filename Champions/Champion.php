<?php

namespace PerfectBuild\Champions;

abstract Class Champion{
	
	protected $level;
	protected $experience;
	protected $current_gold;
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
		
	protected $base_energy;
	protected $energy_per_level;
	protected $base_energy_regen;
	protected $energy_regen_per_level;
	
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
	
	protected $item1_obj;
	protected $item2_obj;
	protected $item3_obj;
	protected $item4_obj;
	protected $item5_obj;
	protected $item6_obj;
	
	protected $summoner1_obj;
	protected $summoner2_obj;
	
	protected $rune_arr;
	
	protected $effects_arr;
		
	public function __construct($summoner_arr, $item_arr, $rune_arr, $masteries_arr) {				
		
		$this->effects_arr = Array();
		
		// Summoners	
		if(count($summoner_arr)>2){
			throw new \Exception('Summoner Count Exeception');
		}
		$summoner1 = '\PerfectBuild\Summoners\\'.$summoner_arr[0];
		$summoner2 = '\PerfectBuild\Summoners\\'.$summoner_arr[1];				
		$this->summoner1_obj 			= new $summoner1();
		$this->summoner2_obj 			= new $summoner2();
		
		// Items	
		if(count($item_arr)>6){
			throw new \Exception('Item Count Exeception');
		}
		$index = 0;
		foreach($item_arr as $item){			
			$index++;	
			$item_num = "item".$index;
			$item = '\PerfectBuild\Items\\'.$item;	
			$this->$$item_num = new $item();
		}
		
		// Runes
		if(count($this->rune_arr['Glyphs']) > 9 || count($this->rune_arr['Marks']) > 9 || count($this->rune_arr['Quintessences']) > 3 || count($this->rune_arr['Seals']) > 9 ){
			throw new \Exception('Rune Count Exeception');
		}
		$this->rune_arr = Array('Glyphs' => Array(),'Marks' => Array(),'Quintessences' => Array(),'Seals' => Array());
		foreach($rune_arr as $rune_type => $rune_type_arr){
			foreach($rune_type_arr as $rune_name){
				$rune_object_name = "\PerfectBuild\Runes\\{$rune_type}\\{$rune_name}";
				$this->rune_arr[$rune_type][] = new $rune_object_name;
			} 
		}
	
		// Masteries
		
		
		// Starting gold
		$this->current_gold = 450.0;
		
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
	
	public function spell1Free(){
		return $this->spell1_obj->free();
	}	
	public function spell2Free(){
		return $this->spell2_obj->free();
	}
	public function spell3Free(){
		return $this->spell3_obj->free();
	}
	public function spell4Free(){
		return $this->spell4_obj->free();
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
			$true_armor_damage = ($damage + ($attacker_stats['critical_chance_percent'] * $attacker_stats['critical_damage_percent'])) * $effective_armor_reduction;
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
			'base_attack_damage'						=> $this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level),
			'bonus_attack_damage'						=> 0.0,
			'attack_damage'								=> $this->base_attack_damage + ((1 - $this->level) * $this->attack_damage_per_level),
			'base_attack_speed'							=> $this->base_attack_speed +  ((1 - $this->level) * $this->attack_speed_per_level),
			'bonus_attack_speed'						=> 0.0,
			'attack_speed'								=> $this->base_attack_speed +  ((1 - $this->level) * $this->attack_speed_per_level),
			'cooldown_reduction'						=> 0.0,
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
			'critical_chance_percent'					=> 0.0,
			'critical_damage_percent'					=> 1.0,
			'energy'									=> $this->base_energy + ((1 - $this->level) * $this->energy_per_level),
			'energy_regeneration_per_5'					=> $this->base_energy_regen + ((1 - $this->level) * $this->energy_regen_per_level),
			'experience_percent'						=> 0.0,
			'gold'										=> $this->current_gold,
			'gold_per_10'								=> 19.0,
			'base_health'								=> $this->base_health + ((1 - $this->level) * $this->health_per_level),
			'bonus_health'								=> 0.0,
			'health'									=> $this->base_health + ((1 - $this->level) * $this->health_per_level),
			'base_health_regeneration_per_5'			=> $this->base_health_regen + ((1 - $this->level) * $this->health_regen_per_level),
			'bonus_health_regeneration_per_5'			=> 0.0,
			'health_regeneration_per_5'					=> $this->base_health_regen + ((1 - $this->level) * $this->health_regen_per_level),
			'mana'										=> $this->base_mana + ((1 - $this->level) * $this->mana_regen_per_level),
			'base_mana_regeneration_per_5'				=> $this->base_mana_regen + ((1 - $this->level) * $this->mana_regen_per_level),
			'bonus_mana_regeneration_per_5_flat'		=> 0.0,
			'bonus_mana_regeneration_per_5_percent'		=> 0.0,
			'mana_regeneration_per_5'					=> $this->base_mana_regen + ((1 - $this->level) * $this->mana_regen_per_level),
			'bonus_movement_speed_percent'				=> 0.0,
			'bonus_movement_speed_flat'					=> 0.0,
			'base_movement_speed'						=> $this->base_movement_speed,
			'movement_speed'							=> $this->base_movement_speed,
			'lifesteal_percent'							=> 0.0,
			'revival_percent'							=> 0.0,
			'item_cooldown_reduction'					=> 0.0,
			'spell_vamp_percent' 						=> 0.0,
			'self_armor_penetration_flat' 				=> 0.0,
			'self_armor_penetration_percent' 			=> 0.0,
			'self_armor_reduction_flat' 				=> 0.0,
			'self_armor_reduction_percent'				=> 0.0,
			'self_magic_resistance_reduction_flat' 		=> 0.0,
			'self_magic_resistance_reduction_percent' 	=> 0.0,
			'self_magic_resistance_penetration_flat' 	=> 0.0,
			'self_magic_resistance_penetration_percent'	=> 0.0,
		);
					
		// Runes
		foreach($this->rune_arr as $rune_type_arr){
			foreach($rune_type_arr as $rune_obj){				
				$stats_arr = $this->addStats($stats_arr, $rune_obj->basicEffectsArr());
			} 
		}
		
		// Items
		if(!is_null($this->item1_obj)){
			$stats_arr = $this->addStats($stats_arr, $this->item1_obj->basicEffectsArr());		
			$effects_arr = $this->item1_obj->effectsArr();
			foreach($effects_arr as $effect){
				$stats_arr = $this->addStats($stats_arr, $effect);
			}
		}
		if(!is_null($this->item2_obj)){
			$stats_arr = $this->addStats($stats_arr, $this->item2_obj->basicEffectsArr());		
			$effects_arr = $this->item2_obj->effectsArr();
			foreach($effects_arr as $effect){
				$stats_arr = $this->addStats($stats_arr, $effect);
			}		
		}
		if(!is_null($this->item3_obj)){
			$stats_arr = $this->addStats($stats_arr, $this->item3_obj->basicEffectsArr());		
			$effects_arr = $this->item3_obj->effectsArr();
			foreach($effects_arr as $effect){
				$stats_arr = $this->addStats($stats_arr, $effect);
			}		
		}
		if(!is_null($this->item4_obj)){
			$stats_arr = $this->addStats($stats_arr, $this->item4_obj->basicEffectsArr());		
			$effects_arr = $this->item4_obj->effectsArr();
			foreach($effects_arr as $effect){
				$stats_arr = $this->addStats($stats_arr, $effect);
			}		
		}
		if(!is_null($this->item5_obj)){
			$stats_arr = $this->addStats($stats_arr, $this->item5_obj->basicEffectsArr());		
			$effects_arr = $this->item5_obj->effectsArr();
			foreach($effects_arr as $effect){
				$stats_arr = $this->addStats($stats_arr, $effect);
			}		
		}
		if(!is_null($this->item6_obj)){
			$stats_arr = $this->addStats($stats_arr, $this->item6_obj->basicEffectsArr());		
			$effects_arr = $this->item6_obj->effectsArr();
			foreach($effects_arr as $effect){
				$stats_arr = $this->addStats($stats_arr, $effect);
			}		
		}
		
		// Masteries
		// TODO: Masteries
		
		// Spell/Ability Effects	
		foreach($this->effects_arr as $effect_obj){	
			$stats_arr = $this->addStats($stats_arr, $effect_obj->basicEffectsArr());
		}
		
		// Cooldown
		if($stats_arr['cooldown_reduction'] > 0.4){
			$stats_arr['cooldown_reduction'] = 0.4;
		}
	
		return $stats_arr;			
	}	

	private function addStats($stats_arr, $basic_effects_arr){
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
					$stats_arr['bonus_health_regeneration_per_5'] += $basic_effect_value;
					$stats_arr['health_regeneration_per_5'] += $basic_effect_value;
				}else if($basic_effect_key == "health_regeneration_scaling_per_5"){
					$stats_arr['bonus_health_regeneration_per_5'] += $basic_effect_value * $this->level;
					$stats_arr['health_regeneration_per_5'] += $basic_effect_value * $this->level;;
				}else if($basic_effect_key == "base_health_regeneration_percent"){
					$stats_arr['bonus_health_regeneration_per_5'] += $stats_arr['base_health_regeneration_per_5'] * $basic_effect_value;
					$stats_arr['health_regeneration_per_5'] += $stats_arr['base_health_regeneration_per_5'] * $basic_effect_value;
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
					$stats_arr['bonus_mana_regeneration_per_5_flat'] += $basic_effect_value;
					$stats_arr['mana_regeneration_per_5'] = $stats_arr['bonus_mana_regeneration_per_5_flat'] + ( $stats_arr['base_mana_regeneration_per_5'] * (1 + $stats_arr['bonus_mana_regeneration_per_5_percent']));
				}else if($basic_effect_key == "mana_regeneration_scaling_per_5"){
					$stats_arr['bonus_mana_regeneration_per_5_flat'] += $basic_effect_value * $this->level;
					$stats_arr['mana_regeneration_per_5'] = $stats_arr['bonus_mana_regeneration_per_5_flat'] + ( $stats_arr['base_mana_regeneration_per_5'] * (1 + $stats_arr['bonus_mana_regeneration_per_5_percent']));
				}else if($basic_effect_key == "mana_regeneration_per_5_percent"){
					$stats_arr['bonus_mana_regeneration_per_5_percent'] += $basic_effect_value;
					$stats_arr['mana_regeneration_per_5'] = $stats_arr['bonus_mana_regeneration_per_5_flat'] + ( $stats_arr['base_mana_regeneration_per_5'] * (1 + $stats_arr['bonus_mana_regeneration_per_5_percent']));
				}else if($basic_effect_key == "mana_scaling"){
					$stats_arr['mana'] += $basic_effect_value * $this->level;
				}else if($basic_effect_key == "bonus_movement_speed_percent"){
					$stats_arr['bonus_movement_speed_percent'] += $basic_effect_value;
					$stats_arr['movement_speed'] = ($stats_arr['base_movement_speed'] + $stats_arr['bonus_movement_speed_flat']) * (1 + $stats_arr['bonus_movement_speed_percent']);
				}else if($basic_effect_key == "bonus_movement_speed_flat"){
					$stats_arr['bonus_movement_speed_flat'] += $basic_effect_value;
					$stats_arr['movement_speed'] = ($stats_arr['base_movement_speed'] + $stats_arr['bonus_movement_speed_flat']) * (1 + $stats_arr['bonus_movement_speed_percent']);
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
		return $stats_arr;
	}	
	
	public function tick($tick_rate){
		// TODO: Fix this	
		
		// Spell cooldowns
		$this->spell1_obj->tick($tick_rate);
		$this->spell2_obj->tick($tick_rate);
		$this->spell3_obj->tick($tick_rate);
		$this->spell4_obj->tick($tick_rate);
		
		// DOT (Damage Over Time) spells
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

